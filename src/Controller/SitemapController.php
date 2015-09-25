<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SitemapController extends Controller {

    /**
     * @Route("/sitemap.{_format}", name="sitemap", Requirements={"_format" = "xml"}))
     */
    public function SitemapAction(Request $request) {
        $sitemap_config = $this->container->getParameter('sitemap');
        $limitPerPage = $sitemap_config['limit'];
        $start = 0;
        if ($request->get('page') != '' && intval($request->get('page')) > 0) {
            $start = ((intval($request->get('page')) - 1) * $limitPerPage);
            /**
             * @Todo You have to replace $DBACTION->LIST with your own function to retrieve data from database
             */
            $list = $DBACTION->LIST($start, $limitPerPage);
        } else {
            /**
             * @Todo You have to replace $DBACTION->COUNT() with your own function to retrieve total records from database
             */
            $count = $DBACTION->COUNT();
            $list = ceil($count / $limitPerPage);
        }


        if ($sitemap_config['gzip'] && function_exists('gzencode') && $request->get('page') != '') {

            $response = new \Symfony\Component\HttpFoundation\Response();
            $sitemap = $this->renderView('::sitemap.xml.twig', array('list' => $list));
            $sitemapGz = gzencode($sitemap);
            $response->headers->set('Content-Type', 'application/x-gzip');
            $response->headers->set('Content-Disposition', 'attachment; filename="sitemap.xml.gz"');
            $response->headers->set('Content-Length', strlen($sitemapGz));
            $response->setContent($sitemapGz);
            $response->send();
        }

        return $this->render('::sitemap.xml.twig', array(
                    'list' => $list,
        ));
    }

}
