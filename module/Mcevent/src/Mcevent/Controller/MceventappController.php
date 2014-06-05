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
namespace Mcevent\Controller;

use ContentinumComponents\Controller\AbstractBackendController;
use Zend\View\Model\ViewModel;

/**
 * Mcevent module application controller
 * 
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 */
class MceventappController extends AbstractBackendController
{

    /**
     * Page application
     * 
     * @see \ContentinumComponents\Controller\AbstractBackendController::application()
     */
    protected function application($ctrl, $page, $mcworkpages, $role = null, $acl = null)
    {
        $entries = array();
        $content = false;
        if ($mcworkpages->$page) {
            $content = $mcworkpages->$page;
        }
        
        $this->adminlayout($this->layout(), $mcworkpages, $page, $role, $acl, $this->getServiceLocator()
            ->get('viewHelperManager'));
        return new ViewModel(array(
            'page' => $page,
            'pagecontent' => $content,
            'entries' => $entries
        ));
    }

    /**
     * (non-PHPdoc)
     * 
     * @see \ContentinumComponents\Controller\AbstractBackendController::displaycontent()
     */
    protected function displaycontent($ctrl, $page, $mcworkpages, $role = null, $acl = null)
    {}

    /**
     * (non-PHPdoc)
     * 
     * @see \ContentinumComponents\Controller\AbstractBackendController::downloadcontent()
     */
    protected function downloadcontent($ctrl, $page, $mcworkpages, $role = null, $acl = null)
    {}

    /**
     * (non-PHPdoc)
     * 
     * @see \ContentinumComponents\Controller\AbstractBackendController::contenthandle()
     */
    protected function contenthandle($ctrl, $page, $mcworkpages, $role = null, $acl = null)
    {}
}