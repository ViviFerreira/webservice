<?php
namespace Controllers\V1;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

final class MainController {
 /**
 * @api {GET} /status Status da API
 * @apiSampleRequest /v1/status
 * @apiVersion 1.0.0
 * @apiDescription Método utilizado para mostrar status da API
 * @apiGroup Sistema
 * @apiSuccess {String} status Mensagem de sucesso
 * 
 * @apiSuccessExample {JSON} Resposta-sucesso
* {
*   "Status": API respondendo
* }
*/

    public static function status(Request $req, Response $res, array $args) {

        return $res->withJson([
            "Status" => "API respondendo"
        ]);
    }
    
    /**
     * @api {POST} /v1/maior Calcular Maior
     * @apiSampleRequest /v1/maior
     * @apiVersion 1.0.0
     * @apiDescription Método que retorna o maior número de um array
     * @apiGroup Arrays
     * 
     * @apiParam (Body) {Array} list Array de valores para calcular o maior.
     * @apiParamExample {JSON} requisicao-exemplo
     * {
     *    "list": [1,5,8,15]   
     * }
     * 
     * @apiSuccess (200) {Integer} Resultado Resultado do cálculo.
     * @apiSuccessExample {JSON} resposta-sucesso
     * {
     *    "Resultado": 15
     * }
     * 
     * @apiError (500) {String} erro Array Inválido.
     * @apiError (500) {String} array-invalido Valor não numérico em alguma posição do array.
     * @apiErrorExample {JSON} resposta-erro
     * {
     *   "Resultado": "Valores não numéricos foram informados!"
     * }
     * 
     */
    public static function maior(Request $req, Response $res, array $args) {
        $list = $req->getParsedBody();
        $arrayList = $list["list"];
        sort($arrayList); //Ordena Array
        $maior = !is_numeric($arrayList[0]) ? "Valores não númericos foram informados!" : max($arrayList); //Valida indice ou pega o maior do array
        return $res->withJson([
            "Resultado" => $maior
        ]);
        
    }

    /**
     * @api {GET} /v1/par-impar/:num Calcular Par ou Impar
     * @apiSampleRequest /v1/par-impar/:num
     * @apiVersion 1.0.0
     * @apiDescription Método que calcula se um número é par ou impar.
     * @apiGroup Math
     * 
     * @apiParam {Number} num Número para calcular se é par ou impar.
     * @apiParamExample {JSON} requisicao-exemplo
     * http://localhost/webservice/v1/par-impar/5
     * @apiSuccess (200) {Integer} Resultado Resultado do cálculo.
     * @apiSuccessExample {JSON} resposta-sucesso
     * {
     *    "Resultado": "Impar"
     * }
     * 
     * @apiError (500) {String} erro Número Inválido.
     * @apiError (500) {String} num-invalido Valor não numérico foi informado.
     * @apiErrorExample {JSON} resposta-erro
     * {
     *   "Resultado": "Valores não numéricos informados!"
     * }
     * 
     */

    public static function parImpar(Request $req, Response $res, array $args) {
        $num = $args["num"];
        $calc = !(is_numeric($num))|| $num == null ? "Valor não numérico foi informado!" : ((int)($num) % 2 == 0 ? "Par" : "Impar");
        return $res->withJson([
            "Resultado" => $calc
        ]);
        
    }

    /**
     * @api {POST} /v1/ordenar Ordenar 
     * @apiSampleRequest /v1/ordenar
     * @apiVersion 1.0.0
     * @apiDescription Método ordena um array de forma crescente ou decrescente
     * @apiGroup Arrays
     * 
     * @apiParam (Body) {Array} list Array de valores para calcular o maior.
     * @apiParam (Body) {String} order Forma de ordenação.
     * @apiParamExample {JSON} requisicao-exemplo1
     * {
     *     "list": [5,1,10,6] 
     *      ,"order" : "asc"
     * }
     * 
     * @apiParamExample {JSON} requisicao-exemplo2
     * {
     *     "list": [5,1,10,6] 
     *      ,"order" : "desc"
     * }
     * 
     * @apiSuccess (200) {Integer} Resultado Resultado do cálculo.
     * @apiSuccessExample {JSON} resposta-sucesso
     * {
     *    "Resultado": [
     *      1,
     *      5,
     *      6,
     *      10
     *    ]
     * }
     * 
     * @apiError (500) {String} erro Ordenação Inválida.
     * @apiError (500) {String} order-invalido Forma de ordenação informada é inválido.
     * @apiErrorExample {JSON} resposta-erro
     * {
     *   "Resultado": "Campo de ordenação inválido!"
     * }
     * 
     */

    public static function ordenar(Request $req, Response $res, array $args) {
        $array = $req->getParsedBody();
        $list = $array["list"];
        $order = trim($array["order"]);
        sort($list); //Ordena Array
        $list = $order == "asc" || $order == "desc" ? $list : "Campo de ordenação inválido!";
        $list = $order == "desc" ? array_reverse($list) : $list; //Inverte Array
        $list = $order == "asc" ? $list : $list;
        return $res->withJson([
            "Resultado" => $list
        ]);
        
    }

}