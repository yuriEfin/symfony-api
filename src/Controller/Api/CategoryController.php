<?php

namespace App\Controller\Api;

use App\Context\Category\Dto\Search\SearchDto;
use App\Context\Category\Interfaces\CategoryManagerInterface;
use App\Controller\Api\Common\AbstractApiController;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route(path: "/api/v1", name: "categories_")]
class CategoryController extends AbstractApiController
{
    private CategoryManagerInterface $categoryManager;
    private ValidatorInterface $validator;
    
    public function __construct(CategoryManagerInterface $categoryManager, SerializerInterface $serializer, ValidatorInterface $validator)
    {
        $this->categoryManager = $categoryManager;
        $this->serializer = $serializer;
        $this->validator = $validator;
    }
    
    #[Route(path: '/categories', name: 'categories', methods: ['GET'],)]
    public function list(Request $request): Response
    {
        $searchDto = new SearchDto(
            $request->get('id'),
            $request->get('ids') ? explode(',', $request->get('ids')) : null,
            $request->get('title'),
            $request->get('child')
        );
        $searchDto->setLimit($request->get('limit'))
            ->setOffset($request->get('offset'));
        
        $errors = $this->validator->validate($searchDto);
        if (count($errors) > 0) {
            throw new UnprocessableEntityHttpException($errors);
        }
        $items = new Paginator($this->categoryManager->getQueryList($searchDto), false);
        
        return $this->json($items);
    }
}
