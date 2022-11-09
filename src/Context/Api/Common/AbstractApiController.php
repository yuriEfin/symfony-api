<?php

namespace App\Context\Api\Common;

use App\Context\Api\Common\Response\Interfaces\ResponseModelInterface;
use App\Context\Api\Common\Response\JsonApiResponse;
use App\Context\Search\Constant\PaginationConstant;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;

abstract class AbstractApiController extends AbstractController
{
    protected ?string $responseModel = null;
    protected ?string $collectionEnvelop = null;
    
    /**
     * Returns a JsonResponse that uses the serializer component if enabled, or json_encode.
     */
    protected function json(mixed $data, int $status = 200, array $headers = [], array $context = []): JsonResponse
    {
        /** @var SerializerInterface $serializer */
        $serializer = $this->container->get('serializer');
        /** @var Request $request */
        $request = $this->container->get('request_stack')->getCurrentRequest();
        
        $data = $serializer->normalize($data);
        
        $limit = $request->get('limit');
        $offset = $request->get('offset');
        /** @var \App\Context\Api\Common\Response\Interfaces\ResponseModelInterface $responseModel */
        $responseModel = new ($this->getResponseModel())();
        $responseModel->setLimit($limit);
        $responseModel->setOffset($offset);
        $responseModel->setCollectionEnvelop($this->getCollectionEnvelop());
        $responseModel->setMeta(
            array_merge(['query' => $request->query->all()], [
                'defaultPageSize' => PaginationConstant::DEFAULT_PAGE_ITEMS_COUNT,
            ])
        );
        $responseModel->setData($data);
    
        $json = $serializer->serialize(
            $responseModel,
            'json',
            array_merge(
                [
                    'json_encode_options' => JsonResponse::DEFAULT_ENCODING_OPTIONS,
                ],
                $context
            )
        );
        
        return new JsonResponse($json, $status, $headers, true);
    }
    
    public function setResponseModel(string $model)
    {
        $this->responseModel = $model;
    }
    
    public function getResponseModel(): string
    {
        return $this->responseModel ?? JsonApiResponse::class;
    }
    
    public function getCollectionEnvelop(): string
    {
        return $this->collectionEnvelop ?? strtolower(basename(str_replace('Controller', '', str_replace('\\', '/', $this::class))));
    }
    
    public function setCollectionEnvelop(string $collectionEnvelop)
    {
        $this->collectionEnvelop = $collectionEnvelop;
    }
}