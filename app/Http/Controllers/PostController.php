<?php

namespace App\Http\Controllers;

use App\Models\Post;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Parte 2.1: Consumir API Externa y guardar datos
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getApiData() {
        $url = 'https://jsonplaceholder.typicode.com/posts';

        $client = new Client();

        $response = $client->request('GET', $url);
        $body = $response->getBody();
        $content = $body->getContents();
        $datas = json_decode($content);

        /* Alternativa para consultar API:
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, 0);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                $response = curl_exec ($ch);
                $err = curl_error($ch);  //if you need
                curl_close ($ch);
        */

        foreach ($datas as $data) {
            $post = new Post();
            $post->title = $data->title;
            $post->body  = $data->body;
            $saved = $post->save();
        }

        return response()->json($datas, 200);
    }

    /**
     * Parte 2.2: EndPoint para consultar datos de forma paginada
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function showdata()
    {
        $posts = DB::table('posts')->paginate(50);
        return response()->json($posts, 200);
    }
}
