<?php
/**
 * contentinum - accessibility websites
 *
 * LICENSE
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED
 * OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * @category contentinum backend
 * @package Controller
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 * @copyright Copyright (c) 2009-2013 jochum-mediaservices, Katja Jochum (http://www.jochum-mediaservices.de)
 * @license http://www.opensource.org/licenses/bsd-license
 * @since contentinum version 5.0
 * @link      https://github.com/Mikel1961/contentinum-components
 * @version   1.0.0
 */
namespace Mcwork\Controller;

use ContentinumComponents\Controller\AbstractContentinumController;
use Zend\View\Model\ViewModel;

/**
 * Dashboard controller backend
 *
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 */
class IndexController extends AbstractContentinumController
{

    /**
     * Backend start page / dashboard
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $this->adminlayout($this->layout(), $this->getServiceLocator()
            ->get('Mcwork\Pages'), 'Mcwork_Controller_Index', $this->getDefaultRole(), $this->getAclService(), $this->getServiceLocator()
            ->get('viewHelperManager'));
        return new ViewModel();
    }

    /**
     * Default user role
     *
     * @return Ambigous <object, multitype:, \Contentinum\Acl\DefaultRole>
     */
    protected function getDefaultRole()
    {
        return $this->getServiceLocator()->get('Contentinum\Acl\DefaultRole');
    }

    /**
     * Acl configuration
     *
     * @return Ambigous <object, multitype:, \Contentinum\Acl\Acl>
     */
    protected function getAclService()
    {
        return $this->getServiceLocator()->get('Contentinum\Acl\Acl');
    }
}