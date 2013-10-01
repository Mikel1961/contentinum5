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
 * @category Mcwork
 * @package Model
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 * @copyright Copyright (c) 2009-2013 jochum-mediaservices, Katja Jochum (http://www.jochum-mediaservices.de)
 * @license http://www.opensource.org/licenses/bsd-license
 * @since contentinum version 5.0
 * @link      https://github.com/Mikel1961/contentinum-components
 * @version   1.0.0
 */
namespace Mcwork\Model;

use ContentinumComponents\Storage\StorageFiles;
use ContentinumComponents\Storage\AbstractStorageEntity;

/**
 * File handle model 
 * Methods to display file content, prepare file content to download, empty and delete log files 
 *
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 */
class Filecontent extends StorageFiles 
{
	
	/**
	 * Reads the entire file and makes it back as a string
	 * @param array $attribs
	 * @param AbstractStorageEntity $entity
	 * @return Ambigous <\ContentinumComponents\Storage\unknown, boolean>
	 */
	public function fetchContent(array $attribs, AbstractStorageEntity $entity) 
	{
		return $this->fetchFileContent ( '/' . $entity->getCurrentPath (), $attribs ['id'] );
	}
	
	/**
	 * Provides the file content for download
	 * Headers must be configure in page meta datas
	 * @param array $attribs
	 * @param AbstractStorageEntity $entity
	 * @return Ambigous <\ContentinumComponents\Storage\unknown, boolean>
	 */
	public function download(array $attribs, AbstractStorageEntity $entity) 
	{
		return $this->fetchFileContent ( '/' . $entity->getCurrentPath (), $attribs ['id'] );
	}
	
	/**
	 * Creates a backup of the original log file and then deletes the contents of the original log file
	 * @param array $attribs
	 * @param AbstractStorageEntity $entity
	 * @return boolean
	 */
	public function emptyLogFile(array $attribs, AbstractStorageEntity $entity) 
	{
		$dest = $this->getStorage ()->getDocumentRoot () . '/' . $entity->getCurrentPath () . '/' . $attribs ['id'] . '_' . time ();
		$this->copyFile ( $dest, '/' . $entity->getCurrentPath (), $attribs ['id'] );
		
		return $this->setFileContent ( '', '/' . $entity->getCurrentPath (), $attribs ['id'] );
	}
	
	/**
	 * Creates a backup of the original log file and then deletes the original log file
	 * Will be a backup file deleted, no backup file will be created
	 * @param array $attribs
	 * @param AbstractStorageEntity $entity
	 */
	public function deleteLogFile(array $attribs, AbstractStorageEntity $entity) 
	{
		if (false === strrpos ( $attribs ['id'], ".bak" )) {
			$dest = $this->getStorage ()->getDocumentRoot () . '/' . $entity->getCurrentPath () . '/' . $attribs ['id'] . '.bak';
			$this->copyFile ( $dest, '/' . $entity->getCurrentPath (), $attribs ['id'] );
		}
		
		return $this->deleteFile ( '/' . $entity->getCurrentPath (), $attribs ['id'] );
	}
}