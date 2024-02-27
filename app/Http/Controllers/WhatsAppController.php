<?php

namespace App\Http\Controllers;

use App\Models\Notificacion;
use App\Models\WhatsApp;
use Illuminate\Http\Request;

class WhatsAppController extends Controller
{
    public function index(Request $request){
    //     $notifications = Notificacion::all(); // Obtener todas las notificaciones
    // return view('dashboard', compact('notifications'));

    // $notificacion = new Notificacion();
    // $notificacion->sender = 'WhatsApp'; // Cambia esto según el remitente real
    // $notificacion->message = $request->mensaje; // Esto obtiene el mensaje del formulario
    // $notificacion->save();

    // // Puedes redirigir a donde desees después de enviar la notificación
    // return redirect()->route('dashboard')->with('success', 'Mensaje enviado y notificación almacenada correctamente.');
    }
    public function envia($recibido, $enviado, $idWA, $timestamp, $telefonoCliente)
    {
        //CONSULTAMOS TODOS LOS REGISTROS CON EL ID DEL MENSAJE
        $cantidad = WhatsApp::where('id_wa', $idWA)->count();
        $cantidad = WhatsApp::all();


        //SI LA CANTIDAD DE REGISTROS ES 0 ENVIAMOS EL MENSAJE DE LO CONTRARIO NO LO ENVIAMOS PORQUE YA SE ENVIO
        if ($cantidad==0) {
            //TOKEN QUE NOS DA FACEBOOK
            $token = 'EAA0cGBz1VmwBO7GJhcxQdscVnjufj4TZB2qNohK5bwgmGVy548NsLxZBtHbCuutcReoVcab1TAweFZAbWtKlGHQCxQUOFiQjWZB0pUOvKTU7XFwmENtDF03esmboA5oZAl2kqBlIPl4Nb659aO7SThdqZCUwXX33w6718TE4g2jbShThdxk9OTyNb9j7IwZAb6c';
            //IDENTIFICADOR DE NÚMERO DE TELÉFONO
            $telefonoID = '224013397467233';
            //URL A DONDE SE MANDARA EL MENSAJE
            $url = 'https://graph.facebook.com/v15.0/' . $telefonoID . '/messages';
            //CONFIGURACION DEL MENSAJE
            $mensaje = ''
                    . '{'
                    . '"messaging_product": "whatsapp", '
                    . '"recipient_type": "individual",'
                    . '"to": "' . $telefonoCliente . '", '
                    . '"type": "text", '
                    . '"text": '
                    . '{'
                    . '     "body":"' . $enviado . '",'
                    . '     "preview_url": true, '
                    . '} '
                    . '}';
            //DECLARAMOS LAS CABECERAS
            $header = array("Authorization: Bearer " . $token, "Content-Type: application/json",);
            //INICIAMOS EL CURL
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $mensaje);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            //OBTENEMOS LA RESPUESTA DEL ENVIO DE INFORMACION
            $response = json_decode(curl_exec($curl), true);
            file_put_contents("response.txt", $response) ;
            //OBTENEMOS EL CODIGO DE LA RESPUESTA
            $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            //CERRAMOS EL CURL
            curl_close($curl);

            WhatsApp::create([
                'fecha_hora' => now(), // O la fecha y hora que prefieras
                'mensaje_recibido' => $recibido,
                'mensaje_enviado' => $enviado,
                'id_wa' => $idWA,
                'timestamp_wa' => $timestamp,
                'telefono_wa' => $telefonoCliente,
            ]);
        }
        return view('dashboard', [
            'mensaje_recibido' => $cantidad
        ]);

    }
    public function webhook()
    {
    //     //TOQUEN QUE QUERRAMOS PONER
    //     $token = 'HolaNovato';
    //     //RETO QUE RECIBIREMOS DE FACEBOOK
    //     $hub_challenge = isset($_GET['hub_challenge']) ? $_GET['hub_challenge'] : '';
    //     //TOQUEN DE VERIFICACION QUE RECIBIREMOS DE FACEBOOK
    //     $hub_verify_token = isset($_GET['hub_verify_token']) ? $_GET['hub_verify_token'] : '';
    //     //SI EL TOKEN QUE GENERAMOS ES EL MISMO QUE NOS ENVIA FACEBOOK RETORNAMOS EL RETO PARA VALIDAR QUE SOMOS NOSOTROS
    //     if ($token === $hub_verify_token) {
    //         echo $hub_challenge;
    //         exit;
    //     }
    //   }
    //   /*
    //   * RECEPCION DE MENSAJES
    //   */
    //   public function recibe(){
    //     //LEEMOS LOS DATOS ENVIADOS POR WHATSAPP
    //     $respuesta = file_get_contents("php://input");
    //     //echo file_put_contents("text.txt", "Hola");
    //     //SI NO HAY DATOS NOS SALIMOS
    //     if($respuesta==null){
    //       exit;
    //     }
    //     //CONVERTIMOS EL JSON EN ARRAY DE PHP
    //     $respuesta = json_decode($respuesta, true);
    //     //EXTRAEMOS EL TELEFONO DEL ARRAY
    //     $mensaje="Telefono:".$respuesta['entry'][0]['changes'][0]['value']['messages'][0]['from']."\n";
    //     //EXTRAEMOS EL MENSAJE DEL ARRAY
    //     $mensaje.="Mensaje:".$respuesta['entry'][0]['changes'][0]['value']['messages'][0]['text']['body'];
    //     //GUARDAMOS EL MENSAJE Y LA RESPUESTA EN EL ARCHIVO text.txt
    //     file_put_contents("text.txt", $mensaje);
     }
    /**
     * Show the form for creating a new resource.
     */
    /**
     * Store a newly created resource in storage.
     */
    // public function reply($notificationId)
    // {
    //     // Aquí puedes obtener los detalles de la notificación según su ID
    //     $notification = Whatsapp::findOrFail($notificationId);

    //     // Puedes pasar estos detalles a la vista de respuesta
    //     return view('reply', compact('notification'));
    // }


    /**
     * Display the specified resource.
     */
    public function show(WhatsApp $whatsApp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WhatsApp $whatsApp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WhatsApp $whatsApp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WhatsApp $whatsApp)
    {
        //
    }
}
