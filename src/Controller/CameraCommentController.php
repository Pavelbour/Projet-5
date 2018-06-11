<?php
    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\HttpFoundation\Request;
    use App\Entity\CameraComment;
    use App\Form\CameraCommentType;

    class CameraCommentController extends Controller
    {
        public function modify(Request $request, $id)
        {
            $em = $this->getDoctrine()->getManager();
            $comment = $em->getRepository(CameraComment::class)->find($id);
            $form = $this->createForm(CameraCommentType::class, $comment);

            $form->handleRequest($request);
        }
    }