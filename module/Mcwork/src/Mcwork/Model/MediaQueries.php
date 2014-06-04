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

use ContentinumComponents\Mapper\Worker;
use Mcwork\Model\Exception\InvalidValueModelException;

/**
 * Model MediaQueries
 * Query WebMedia Entity
 *
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 */
class MediaQueries extends Worker
{
    /**
     * Build query and get result
     * @param array $columns
     * @param array $where
     * @param string $entityName
     * @throws InvalidValueModelException
     * @return array
     */
    public function fetchMediaTable(array $columns, array $where = null, $entityName = null)
    {
        $em = $this->getStorage();
        if (null === $entityName) {
            $entityName = $this->getEntityName();
            if (false === $entityName) {
                throw new InvalidValueModelException('Entity can not be found or is not available!');
            }
        }
        $builder = $em->createQueryBuilder();
        $builder->add('select', 'main.' . implode(', main.', $columns));
        $builder->add('from', $entityName . ' AS main');
        if (is_array($where) && ! empty($where)) {
            foreach ($where as $conditions) {
                $builder->where($conditions['cond']);
                $builder->setParameter($conditions['param'][0], $conditions['param'][1]);
            }
        }
        $query = $builder->getQuery();
        return $query->getResult();
    }
}