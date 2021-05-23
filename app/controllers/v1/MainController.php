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
     * @api {POST} /v1/maior Retornar Maior
     * @apiSampleRequest /v1/maior
     * @apiVersion 1.0.0
     * @apiDescription Método que retorna o maior número de um array
     * @apiGroup Array
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
     *   "Resultado": "Valores nao numericos foram informados!"
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
}