<?php
/*
 * WellCommerce Open-Source E-Commerce Platform
 *
 * This file is part of the WellCommerce package.
 *
 * (c) Adam Piotrowski <adam@wellcommerce.org>
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 */
namespace WellCommerce\Bundle\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use WellCommerce\Bundle\AdminBundle\Manager\AdminManagerInterface;
use WellCommerce\Bundle\CoreBundle\Controller\AbstractController;
use WellCommerce\Bundle\FormBundle\Elements\FormInterface;

/**
 * Class AbstractAdminController
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 *
 * @Sensio\Bundle\FrameworkExtraBundle\Configuration\Template()
 */
abstract class AbstractAdminController extends AbstractController implements AdminControllerInterface
{
    /**
     * @var AdminManagerInterface
     */
    private $manager;

    /**
     * Constructor
     *
     * @param AdminManagerInterface $manager
     */
    public function __construct(AdminManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Controller index action
     *
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function indexAction()
    {
        return [
            'datagrid' => $this->manager->getDataGrid()
        ];
    }

    /**
     * Default DataGrid view action
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function gridAction(Request $request)
    {
        $datagrid = $this->manager->getDataGrid();

        try {
            $results = $datagrid->loadResults($request);
        } catch (\Exception $e) {
            $results = nl2br($e->getMessage());
        }

        return $this->jsonResponse($results);
    }

    /**
     * Default add action
     *
     * @param Request $request
     *
     * @return array|JsonResponse
     */
    public function addAction(Request $request)
    {
        $resource = $this->manager->initResource();
        $form     = $this->manager->getForm($resource);

        if ($form->handleRequest()->isSubmitted()) {
            if ($valid = $form->isValid()) {
                $this->manager->createResource($resource, $request);
            }

            return $this->createJsonDefaultResponse($form);
        }

        return [
            'form' => $form
        ];
    }

    /**
     * Default edit action
     *
     * @param Request $request
     *
     * @return array|JsonResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function editAction(Request $request)
    {
        $resource = $this->manager->findResource($request);
        if (null === $resource) {
            return $this->redirectToAction('index');
        }

        $form = $this->manager->getForm($resource);

        if ($form->handleRequest()->isSubmitted()) {
            if ($form->isValid()) {
                $this->manager->updateResource($resource, $request);
            }

            return $this->createJsonDefaultResponse($form);
        }

        return [
            'form' => $form,
        ];
    }

    /**
     * Creates default response for form instance
     *
     * @param FormInterface $form
     *
     * @return JsonResponse
     */
    protected function createJsonDefaultResponse(FormInterface $form)
    {
        return $this->jsonResponse([
            'valid'      => $form->isValid(),
            'continue'   => $form->isAction('continue'),
            'next'       => $form->isAction('next'),
            'redirectTo' => $this->getRedirectToActionUrl('index'),
            'error'      => $form->getError()
        ]);
    }

    /**
     * Default delete action
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function deleteAction($id)
    {
        $this->manager->getDoctrineHelper()->disableFilter('locale');

        try {
            $resource = $this->manager->getRepository()->find($id);
            $this->manager->removeResource($resource);
        } catch (\Exception $e) {
            return $this->jsonResponse(['error' => $e->getMessage()]);
        }

        return $this->jsonResponse(['success' => true]);
    }

    /**
     * Returns manager object
     *
     * @return AdminManagerInterface
     */
    protected function getManager()
    {
        return $this->manager;
    }
}
