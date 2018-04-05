<?php
/**
 * Created by PhpStorm.
 * User: iuppiter NUC
 * Date: 26-5-2017
 * Time: 21:41
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Document;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

/**
 * Class DownloadController
 * @package AppBundle\Controller
 */
class DownloadController extends Controller
{

    /**
     * @Route("/check/{description}/{_entity}/{id}/hash/{_hash}", name="download")
     * @param $description
     * @param $_entity
     * @param $id
     * @param $_hash
     * @Method("GET")
     * @return Response
     */
    public function downloadAction($description, $_entity, $id, $_hash)
    {

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:' . $_entity)
            ->findOneBy(['id' => $id]);

        $found = false;

        if ($_entity != 'Document') {
            /** @var Document $document */
            foreach ($entity->getDocuments() as $document) {
                if ($document->getDocumentPath() == $_hash) {
                    $found = true;
                }
            }
        } else {
            if ($entity->getDocumentPath() == $_hash) {
                $found = true;
            }
        }

        if (!$found) {
            return new Response(null, 403);
        }

        $hash = $em->getRepository('AppBundle:Hash')
            ->findOneBy(['hash' => $_hash]);

        $directory = $this->getParameter('document_directory');

        $filePath = $directory . '/' . $_hash;

        $fs = new FileSystem();
        if (!$fs->exists($filePath)) {
            throw $this->createNotFoundException();
        }

        $filename = $description . '.' . $hash->getExtension();

        // prepare BinaryFileResponse
        $response = new BinaryFileResponse($filePath);
        $response->trustXSendfileTypeHeader();
        $response->setContentDisposition(
            ResponseHeaderBag::DISPOSITION_INLINE,
            $filename,
            iconv('UTF-8', 'ASCII//TRANSLIT', $filename)
        );

        return $response;

    }
}