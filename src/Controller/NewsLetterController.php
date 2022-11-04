<?php

namespace App\Controller;

use App\Entity\NewsLetter;
use App\Form\NewsLetterType;
use App\Repository\NewsLetterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/news/letter')]
class NewsLetterController extends AbstractController
{
    #[Route('/', name: 'app_news_letter_index', methods: ['GET'])]
    public function index(NewsLetterRepository $newsLetterRepository): Response
    {
        return $this->render('news_letter/index.html.twig', [
            'news_letters' => $newsLetterRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_news_letter_new', methods: ['GET', 'POST'])]
    public function new(Request $request, NewsLetterRepository $newsLetterRepository): Response
    {
        $newsLetter = new NewsLetter();
        $form = $this->createForm(NewsLetterType::class, $newsLetter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newsLetterRepository->save($newsLetter, true);

            return $this->redirectToRoute('app_news_letter_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('news_letter/new.html.twig', [
            'news_letter' => $newsLetter,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_news_letter_show', methods: ['GET'])]
    public function show(NewsLetter $newsLetter): Response
    {
        return $this->render('news_letter/show.html.twig', [
            'news_letter' => $newsLetter,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_news_letter_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, NewsLetter $newsLetter, NewsLetterRepository $newsLetterRepository): Response
    {
        $form = $this->createForm(NewsLetterType::class, $newsLetter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newsLetterRepository->save($newsLetter, true);

            return $this->redirectToRoute('app_news_letter_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('news_letter/edit.html.twig', [
            'news_letter' => $newsLetter,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_news_letter_delete', methods: ['POST'])]
    public function delete(Request $request, NewsLetter $newsLetter, NewsLetterRepository $newsLetterRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$newsLetter->getId(), $request->request->get('_token'))) {
            $newsLetterRepository->remove($newsLetter, true);
        }

        return $this->redirectToRoute('app_news_letter_index', [], Response::HTTP_SEE_OTHER);
    }
}
