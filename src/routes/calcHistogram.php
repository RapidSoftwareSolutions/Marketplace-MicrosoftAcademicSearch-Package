<?php

$app->post('/api/MicrosoftAcademicSearch/calcHistogram', function ($request, $response) {

    $settings = $this->settings;
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['key','region','expr']);

    if(!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback']=='error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }

    $requiredParams = ['key'=>'key','region'=>'region','expr'=>'expr'];
    $optionalParams = ['model'=>'model','attributes'=>'attributes','count'=>'count','offset'=>'offset'];
    $bodyParams = [
       'query' => ['expr','model','attributes','count','offset']
    ];

    $data = \Models\Params::createParams($requiredParams, $optionalParams, $post_data['args']);

    
    $data['attributes'] = \Models\Params::toString($data['attributes'], ','); 

    $client = $this->httpClient;
    $query_str = "http://{$data['region']}.api.cognitive.microsoft.com/academic/v1.0/calchistogram";

    

    $requestParams = \Models\Params::createRequestBody($data, $bodyParams);
    $requestParams['headers'] = ["Ocp-Apim-Subscription-Key"=>"{$data['key']}", "Content-Type "=>"application/json"];
     

    try {
        $resp = $client->get($query_str, $requestParams);
        $responseBody = $resp->getBody()->getContents();

        if(in_array($resp->getStatusCode(), ['200', '201', '202', '203', '204'])) {
            $result['callback'] = 'success';
            $result['contextWrites']['to'] = is_array($responseBody) ? $responseBody : json_decode($responseBody);
            if(empty($result['contextWrites']['to'])) {
                $result['contextWrites']['to']['status_msg'] = "Api return no results";
            }
        } else {
            $result['callback'] = 'error';
            $result['contextWrites']['to']['status_code'] = 'API_ERROR';
            $result['contextWrites']['to']['status_msg'] = json_decode($responseBody);
        }

    } catch (\GuzzleHttp\Exception\ClientException $exception) {

        $responseBody = $exception->getResponse()->getBody()->getContents();
        if(empty(json_decode($responseBody))) {
            $out = $responseBody;
        } else {
            $out = json_decode($responseBody);
        }
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'API_ERROR';
        $result['contextWrites']['to']['status_msg'] = $out;

    } catch (GuzzleHttp\Exception\ServerException $exception) {

        $responseBody = $exception->getResponse()->getBody()->getContents();
        if(empty(json_decode($responseBody))) {
            $out = $responseBody;
        } else {
            $out = json_decode($responseBody);
        }
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'API_ERROR';
        $result['contextWrites']['to']['status_msg'] = $out;

    } catch (GuzzleHttp\Exception\ConnectException $exception) {
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'INTERNAL_PACKAGE_ERROR';
        $result['contextWrites']['to']['status_msg'] = 'Something went wrong inside the package.';

    }

    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);

});