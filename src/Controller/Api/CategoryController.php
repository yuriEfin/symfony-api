<?php

namespace App\Controller\Api;

use App\Context\Category\Dto\Search\SearchDto;
use App\Context\Category\Interfaces\CategoryManagerInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route(path: "/api", name: "category_")]
class CategoryController extends AbstractController
{
    private CategoryManagerInterface $categoryManager;
    private SerializerInterface $serializer;
    private ValidatorInterface $validator;
    
    public function __construct(CategoryManagerInterface $categoryManager, SerializerInterface $serializer, ValidatorInterface $validator)
    {
        $this->categoryManager = $categoryManager;
        $this->serializer = $serializer;
        $this->validator = $validator;
    }
    
    #[Route(path: '/category', name: 'category', methods: ['GET'],)]
    public function list(Request $request): Response
    {
        $searchDto = new SearchDto(
            $request->get('id'),
            $request->get('ids') ? explode(',', $request->get('ids')) : null,
            $request->get('title'),
            $request->get('child')
        );
        $errors = $this->validator->validate($searchDto);
        if (count($errors) > 0) {
            throw new UnprocessableEntityHttpException($errors);
        }
        $items = new Paginator($this->categoryManager->getQueryList($searchDto), false);
        
        return $this->json($items);
    }
}
