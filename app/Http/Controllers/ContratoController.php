<?php

namespace App\Http\Controllers;
use Exception;
use App\Models\Contrato;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;
use DateTime;
use DateInterval;
use NumberFormatter;

require 'vendor/autoload.php';
$meses = array(
    1 => 'Enero',
    2 => 'Febrero',
    3 => 'Marzo',
    4 => 'Abril',
    5 => 'Mayo',
    6 => 'Junio',
    7 => 'Julio',
    8 => 'Agosto',
    9 => 'Septiembre',
    10 => 'Octubre',
    11 => 'Noviembre',
    12 => 'Diciembre'
);

class ContratoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('contratos.contrato');
    }
    /**
     * CODIGO EXTRAIDO DE CONTRATOS/METODOS.PHP
    */
    public function crearCarpetaCliente($nombre_cliente, $fechaActual)
    {
        $nombreUsuario = getenv("USERNAME"); //Obtiene el nombre del usuario desde la EV
        $nombreCarpeta = $nombre_cliente . " " . $fechaActual;
        $rutaCarpeta = "C:\\Users\\$nombreUsuario\\Documents\\Contratos\\$nombreCarpeta";
        if (!is_dir($rutaCarpeta)) {
            if (!mkdir($rutaCarpeta, 0777, true)) {
                throw new Exception("Error al crear la carpeta"); // Lanza una excepción en caso de error
            }
        } else {
            return $rutaCarpeta;
        }
    }
    public function generarDiferimiento($contrato, $numero_sucesivo, $ciudad, $numCedula, $fechaActual, $nombre_cliente, $rutaSaveContrato)
    {
        global $meses;
        list($ano, $mes, $dia) = explode('-', $fechaActual);
        $fechaFormateada = $dia . " de " . $meses[intval($mes)] . " del " . $ano;
        $templateWord = new TemplateProcessor(resource_path("docs/DIFERIMIENTO QORIT.docx"));
        $nombre_cliente = strtoupper($nombre_cliente);
        $ciudad = strtoupper($ciudad);
        $templateWord->setValue('edit_contrato_id', $contrato);
        $templateWord->setValue('edit_num_cliente', $numero_sucesivo);
        $templateWord->setValue('edit_ciudad', $ciudad);
        $templateWord->setValue('edit_numero_cedula', $numCedula);
        $templateWord->setValue('edit_fecha_contrato', $fechaFormateada);
        $templateWord->setValue('edit_nombres_apellidos', $nombre_cliente);
        $nombreArchivo = 'QTDiferimiento' . $numero_sucesivo . " " . $nombre_cliente . '.docx';
        $pathToSave = $rutaSaveContrato . '\\' . $nombreArchivo;
        $templateWord->saveAs($pathToSave);
    }
    public function generarVerificacion($nombre_cliente, $numero_sucesivo, $numCedula, $rutaSaveContrato)
    {
        $nombre_cliente = strtoupper($nombre_cliente);
        $templateWord = new TemplateProcessor(resource_path("docs/VERIFICACION.docx"));
        $templateWord->setValue('edit_nombres_apellidos', $nombre_cliente);
        $templateWord->setValue('edit_numero_cedula', $numCedula);
        $nombreArchivo = 'QTVerificacion' . $numero_sucesivo . " " . $nombre_cliente . '.docx';
        $pathToSave = $rutaSaveContrato . '\\' . $nombreArchivo;
        $templateWord->saveAs($pathToSave);
    }
    public function generarFechasPagare($fecha_inicial, $valor,$abono, $numCuotas)
    {
        $fecha = new DateTime($fecha_inicial);

        $valor = $valor-$abono;
        $monto_cuota = number_format(($valor) / $numCuotas, 2);
        $resultados = array();
        for ($i = 0; $i < $numCuotas; $i++) {
            $saldo_restante = number_format($valor - ($i * $monto_cuota), 2);
            $resultados[] = array(
                'fecha' => $fecha->format('Y-m-d'),
                'monto' => $monto_cuota,
                'saldo_restante' => $saldo_restante,
                'num_cuota' => $i + 1,
                'saldo_post_pago' => number_format($valor - (($i + 1) * $monto_cuota), 2)
            );
            $fecha->add(new DateInterval('P1M'));
        }
        if($resultados[$numCuotas-1]['saldo_post_pago']!=0){
            $resultados[$numCuotas-1]['saldo_post_pago'] = 0 ;
            $resultados[$numCuotas-1]['monto'] = number_format($valor-(($numCuotas-1)*$monto_cuota), 2) ;
        }
        return $resultados;
    }
    public function generarPagaresCredito($fechaInicio, $monto,$abono, $numCuotas, $rutaSaveContrato, $numero_sucesivo, $nombre_cliente, $ciudad, $numCedula, $fechaActual, $email)
    {
        global $meses;
        list($ano, $mes, $dia) = explode('-', $fechaActual);
        $nombre_cliente = strtoupper($nombre_cliente);
        $ciudadMayu = strtoupper($ciudad);
        $ciudad = ucwords($ciudad);
        $numCedula = strtoupper($numCedula);
        $fmt = new NumberFormatter('es', NumberFormatter::SPELLOUT);
        $montoSaldoPrevText = $fmt->format($monto);
        $montoSaldoPrevText = strtoupper($montoSaldoPrevText);
        $fechaFormateada = $dia . " días del mes de " . $meses[intval($mes)] . " de " . $ano;
        if ($numCuotas == 12) {
            $templateWord = new TemplateProcessor(resource_path("docs/PAGARÉ CREDITO DIRECTO 12.docx"));
            $listaFechasPagare = $this->generarFechasPagare($fechaInicio, $monto,$abono, $numCuotas);
        }
        if ($numCuotas == 24) {
            $templateWord = new TemplateProcessor(resource_path("docs/PAGARÉ CREDITO DIRECTO 24.docx"));
            $listaFechasPagare = $this->generarFechasPagare($fechaInicio, $monto,$abono, $numCuotas);
        }
        if ($numCuotas == 36) {
            $templateWord = new TemplateProcessor(resource_path("docs/PAGARÉ CREDITO DIRECTO 36.docx"));
            $listaFechasPagare = $this->generarFechasPagare($fechaInicio, $monto,$abono, $numCuotas);
        }
        for ($i = 1; $i <= $numCuotas; $i++) {
            $templateWord->setValue("edit_saldo_prev_{$i}", $listaFechasPagare[$i - 1]["saldo_restante"]);
            $templateWord->setValue("edit_fecha_pago_{$i}", $listaFechasPagare[$i - 1]["fecha"]);
            $templateWord->setValue("edit_cuotas_rest_{$i}", $listaFechasPagare[$i - 1]["num_cuota"]);
            $templateWord->setValue("edit_pago_mensual_{$i}", $listaFechasPagare[$i - 1]["monto"]);
            $templateWord->setValue("edit_pago_final_{$i}", $listaFechasPagare[$i - 1]["saldo_post_pago"]);
        }
        $templateWord->setValue('edit_nombres_apellidos', $nombre_cliente);
        $templateWord->setValue('edit_numero_cedula', $numCedula);
        $templateWord->setValue('edit_ciudad', $ciudad);
        $templateWord->setValue('edit_ciudad_mayu', $ciudadMayu);
        $templateWord->setValue('edit_saldo_prev_1_text', $montoSaldoPrevText);
        $templateWord->setValue('edit_fecha_texto', $fechaFormateada);
        $templateWord->setValue('edit_email', $email);
        $templateWord->setValue('edit_monto_contrato', $monto);


        $nombreArchivo = 'QTPagareCreditos' . $numero_sucesivo . " " . $nombre_cliente . '.docx';
        $pathToSave = $rutaSaveContrato . '\\' . $nombreArchivo;
        $templateWord->saveAs($pathToSave);
    }
    public function generarBeneficiosAlcance($contrato, $numero_sucesivo, $nombre_cliente, $numCedula, $bonoQory, $bonoQoryInt, $rutaSaveContrato, $clausulaCDBoolean)
    {
        $nombre_cliente = strtoupper($nombre_cliente);
        $titulo_bono = "16. BONO DE HOSPEDAJE QORY LOYALTY: ";
        $texto_bono = "Acepto y recibo UN Bono de Hospedaje 3 Días 2 Noches para 06 personas. Previo pago de Impuestos. Uso exclusivo en departamentos de la compañía. No incluye ningún tipo de alimentación";
        $titulo_bonoInt = "17. BONO DE HOSPEDAJE INTERNACIONAL QORY LOYALTY: ";
        $clausulaCD = "";
        if ($clausulaCDBoolean) {
            $clausulaCD = "Los beneficios se habilitarán conforme al contrato de programa turístico suscrito y al reglamento interno de QORIT TRAVEL AGENCY S.A.";
        }
        $texto_bonoInt = "Acepto y recibo Un Bono de Hospedaje 4 Noches 5 Días para 05 personas. Previo pago de Impuestos, si incluye alimentación. PREVIA RESERVA. Destino: Cancún - México";
        $templateWord = new TemplateProcessor(resource_path("docs/ANEXO 3 BENEFICIOS ALCANCE DE LA OFERTA.docx"));
        $templateWord->setValue('edit_nombres_apellidos', $nombre_cliente);
        $templateWord->setValue('edit_contrato_id', $contrato);
        $templateWord->setValue('edit_numero_cedula', $numCedula);
        $templateWord->setValue('edit_num_cliente', $numero_sucesivo);
        $templateWord->setValue('edit_beneficios_alcance', $clausulaCD);
        if ($bonoQory && !$bonoQoryInt) {
            $templateWord->setValue('edit_bono_hospedaje', $titulo_bono);
            $templateWord->setValue('edit_texto_bono_hospedaje', $texto_bono);
            $templateWord->setValue('edit_bono_hospedaje_intern', "");
            $templateWord->setValue('edit_texto_bono_hospedaje_intern', "");
        } else if (($bonoQoryInt && $bonoQory) || ($bonoQoryInt && !$bonoQory)) {
            $templateWord->setValue('edit_bono_hospedaje_intern', $titulo_bonoInt);
            $templateWord->setValue('edit_texto_bono_hospedaje_intern', $texto_bonoInt);
            $templateWord->setValue('edit_bono_hospedaje', $titulo_bono);
            $templateWord->setValue('edit_texto_bono_hospedaje', $texto_bono);
        } else {
            $templateWord->setValue('edit_bono_hospedaje_intern', "");
            $templateWord->setValue('edit_texto_bono_hospedaje_intern', "");
            $templateWord->setValue('edit_bono_hospedaje', "");
            $templateWord->setValue('edit_texto_bono_hospedaje', "");
        }
        $nombreArchivo = 'QTBeneficiosDeAlcance' . $numero_sucesivo . " " . $nombre_cliente . '.docx';
        $pathToSave = $rutaSaveContrato . '\\' . $nombreArchivo;
        $templateWord->saveAs($pathToSave);
    }

    public function generarContrato($contrato, $nombre_cliente, $numero_sucesivo, $numCedula, $montoContrato, $aniosContrato, $formasPago, $email, $fechaActual, $ciudad, $rutaSaveContrato)
    {
        $formasPagoS = "";
        $formasPagoArray = array();
        foreach ($formasPago as $forma) {
            $formasPagoS .= $forma . "\n";
            $formasPagoArray[] = $forma;
        }

        global $meses;
        list($ano, $mes, $dia) = explode('-', $fechaActual);
        $nombre_cliente = strtoupper($nombre_cliente);
        $fmt = new NumberFormatter('es', NumberFormatter::SPELLOUT);
        $montoContratoText = $fmt->format($montoContrato);
        $aniosContratoText = $fmt->format($aniosContrato);
        $aniosContratoText = strtoupper($aniosContratoText);
        $montoContratoText = strtoupper($montoContratoText);
        $fechaFormateada = $dia . " días del mes de " . $meses[intval($mes)] . ", año " . $ano;
        $templateWord = new TemplateProcessor(resource_path("docs/Contrato de agencia de viajes_QORIT.docx"));
        $templateWord->setValue('edit_nombres_apellidos', $nombre_cliente);
        $templateWord->setValue('edit_contrato_id', $contrato);
        $templateWord->setValue('edit_num_cliente', $numero_sucesivo);
        $templateWord->setValue('edit_numero_cedula', $numCedula);
        $templateWord->setValue('edit_monto_contrato', $montoContrato);
        $templateWord->setValue('edit_anios_contrato', $aniosContrato);
        for ($i = 1; $i <= count($formasPagoArray); $i++) {
            $templateWord->setValue("edit_forma_pago_$i", $formasPagoArray[$i - 1]);
        }
        for ($i = count($formasPagoArray); $i <= 5; $i++) {
            $templateWord->setValue("edit_forma_pago_$i", "");
        }
        $templateWord->setValue('edit_email', $email);
        $templateWord->setValue('edit_ciudad', $ciudad);
        $templateWord->setValue('edit_texto_anios_contrato', $aniosContratoText);
        $templateWord->setValue('edit_monto_contrato_texto', $montoContratoText);
        $templateWord->setValue('edit_fecha_texto', $fechaFormateada);
        $nombreArchivo = 'QTContrato' . $numero_sucesivo . " " . $nombre_cliente . '.docx';
        $pathToSave = $rutaSaveContrato . '\\' . $nombreArchivo;
        $templateWord->saveAs($pathToSave);
    }

    public function generarContratoCreditoDirecto($contrato, $nombre_cliente, $numero_sucesivo, $numCedula, $montoContrato, $aniosContrato, $formasPago, $email, $fechaActual, $ciudad, $rutaSaveContrato, $abonoCD, $numCuotasCD, $valorCuotaCD)
    {
        global $meses;
        list($ano, $mes, $dia) = explode('-', $fechaActual);

        $nombre_cliente = strtoupper($nombre_cliente);
        $fmt = new NumberFormatter('es', NumberFormatter::SPELLOUT);
        $montoContratoText = $fmt->format($montoContrato);
        $aniosContratoText = $fmt->format($aniosContrato);
        $abonoContratoText = $fmt->format($abonoCD);
        $valorCuotaDolares = floor($valorCuotaCD);
        $valorCentavosDolares = round(($valorCuotaCD - $valorCuotaDolares) * 100);
        $valorCuotaDolaresText = $fmt->format($valorCuotaDolares);
        $valorCentavosDolaresText = $fmt->format($valorCentavosDolares);
        $cuotaValorContratoText = $valorCuotaDolaresText . " con " . $valorCentavosDolaresText;
        $aniosContratoText = strtoupper($aniosContratoText);
        $montoContratoText = strtoupper($montoContratoText);
        $abonoContratoText = strtoupper($abonoContratoText);
        $cuotaValorContratoText = strtoupper($cuotaValorContratoText);
        $fechaFormateada = $dia . " días del mes de " . $meses[intval($mes)] . ", año " . $ano;
        $templateWord = new TemplateProcessor(resource_path("docs/Contrato de agencia de viajes_QORIT CD.docx"));
        $templateWord->setValue('edit_nombres_apellidos', $nombre_cliente);
        $templateWord->setValue('edit_contrato_id', $contrato);
        $templateWord->setValue('edit_num_cliente', $numero_sucesivo);
        $templateWord->setValue('edit_numero_cedula', $numCedula);
        $templateWord->setValue('edit_monto_contrato', $montoContrato);
        $templateWord->setValue('edit_anios_contrato', $aniosContrato);
        $templateWord->setValue('edit_email', $email);
        $templateWord->setValue('edit_ciudad', $ciudad);
        $templateWord->setValue('edit_texto_anios_contrato', $aniosContratoText);
        $templateWord->setValue('edit_monto_contrato_texto', $montoContratoText);
        $templateWord->setValue('edit_fecha_texto', $fechaFormateada);
        $templateWord->setValue('edit_abono_CD', $abonoCD);
        $templateWord->setValue('edit_abono_letras_CD', $abonoContratoText);
        $templateWord->setValue('edit_num_coutas_CD', $numCuotasCD);
        $templateWord->setValue('edit_monto_cuota_CD', $valorCuotaCD);
        $templateWord->setValue('edit_monto_cuota_letas_CD', $cuotaValorContratoText);
        $nombreArchivo = 'QTContratoCD' . $numero_sucesivo . " " . $nombre_cliente . '.docx';
        $pathToSave = $rutaSaveContrato . '\\' . $nombreArchivo;
        $templateWord->saveAs($pathToSave);
    }
    public function generarPagare($nombre_cliente, $numCedula, $numero_sucesivo, $fechaVencimiento, $ciudad, $email, $valor_pagare, $fechaActual, $numCuotas, $montoCuotaPagare, $pagareText, $rutaSaveContrato)
    {
        global $meses;
        list($ano, $mes, $dia) = explode('-', $fechaActual);
        list($ano2, $mes2, $dia2) = explode('-', $fechaVencimiento);
        $fechaFormateada = " a los " . $dia . " dias, del mes de " . $meses[intval($mes)] . " del " . $ano;
        $fechaFormatVencimiento = $dia2 . ' DE ' . strtoupper($meses[intval($mes2)]) . ' DEL ' . $ano2;
        $nombre_cliente = strtoupper($nombre_cliente);
        $fmt = new NumberFormatter('es', NumberFormatter::SPELLOUT);
        $pagareText = $fmt->format($valor_pagare);
        $pagareText = strtoupper($pagareText);
        $montoCuotaPagare = ($valor_pagare / $numCuotas);
        $templateWord = new TemplateProcessor(resource_path("docs/PAGARE QORIT.docx"));
        $templateWord->setValue('edit_nombres_apellidos', $nombre_cliente);
        $templateWord->setValue('edit_numero_cedula', $numCedula);
        $templateWord->setValue('edit_fecha_vencimiento', $fechaFormatVencimiento);
        $templateWord->setValue('edit_ciudad', $ciudad);
        $templateWord->setValue('edit_email', $email);
        $templateWord->setValue('edit_num_cuotas', $numCuotas);
        $templateWord->setValue('edit_monto_pagare_text', $pagareText);
        $templateWord->setValue('edit_fecha_texto', $fechaFormateada);
        $templateWord->setValue('edit_monto_cuota_pagare', $montoCuotaPagare);
        $templateWord->setValue('edit_monto_pagare', $valor_pagare);
        $nombreArchivo = 'QTPagare' . $numero_sucesivo . " " . $nombre_cliente . '.docx';
        $pathToSave = $rutaSaveContrato . '\\' . $nombreArchivo;
        $templateWord->saveAs($pathToSave);
    }

    public function generarCheckList($contrato, $numero_sucesivo, $ciudad, $provincia,  $numCedula, $email, $fechaActual, $nombre_cliente, $ubicacionSala, $rutaSaveContrato, $credDirBoolean)
    {
        global $meses;
        $nombre_cliente = strtoupper($nombre_cliente);
        $ubicacionSala = strtoupper($ubicacionSala);
        $ciudadMayu = strtoupper($ciudad);
        $ciudad = ucwords($ciudad);
        global $meses;
        $textoAnexo2 =  "PARA PAGOS CON TARJETA";
        if ($credDirBoolean) {
            $textoAnexo2 = "Debito Automatico";
        }
        $textoAnexo2 = strtoupper($textoAnexo2);
        list($ano, $mes, $dia) = explode('-', $fechaActual);
        $fechaFormateada = $dia . " de " . $meses[intval($mes)] . " del " . $ano;
        $templateWord = new TemplateProcessor(resource_path("docs/CHECK LIST QORIT.docx"));
        $templateWord->setValue('edit_contrato_id', $contrato);
        $templateWord->setValue('edit_num_cliente', $numero_sucesivo);
        $templateWord->setValue('edit_ciudad', $ciudad);
        $templateWord->setValue('edit_ciudad_mayu', $ciudadMayu);
        $templateWord->setValue('edit_provincia', $provincia);
        $templateWord->setValue('edit_fecha_contrato', $fechaActual);
        $templateWord->setValue('edit_nombres_apellidos', $nombre_cliente);
        $templateWord->setValue('edit_numero_cedula', $numCedula);
        $templateWord->setValue('edit_sala_lugar', $ubicacionSala);
        $templateWord->setValue('edit_email', $email);
        $templateWord->setValue('edit_fecha_texto', $fechaFormateada);
        $templateWord->setValue('edit_anexo2_CD', $textoAnexo2);
        $nombreArchivo = 'QTCheckList' . $numero_sucesivo . " " . $nombre_cliente . '.docx';
        $pathToSave = $rutaSaveContrato . '\\' . $nombreArchivo;
        $templateWord->saveAs($pathToSave);
    }

    //--------------------------------------------------------------------------------

    public function create(Request $request){

    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
     //
    }


    /**
     * Display the specified resource.
     */
    public function show(Contrato $contrato)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contrato $contrato)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contrato $contrato)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contrato $contrato)
    {
        //
    }
}
