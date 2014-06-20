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
 * @package Forms
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 * @copyright Copyright (c) 2009-2013 jochum-mediaservices, Katja Jochum (http://www.jochum-mediaservices.de)
 * @license http://www.opensource.org/licenses/bsd-license
 * @since contentinum version 5.0
 * @link      https://github.com/Mikel1961/contentinum-components
 * @version   1.0.0
 */
namespace Mcwork\Form;

use ContentinumComponents\Forms\AbstractForms;

/**
 * contentinum mcwork form page
 *
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 */
class MediaMetasForm extends AbstractForms
{

    /**
     * Media Type
     *
     * @var string
     */
    protected $mediaType = false;

    /**
     *
     * @return the $mediaType
     */
    public function getMediaType()
    {
        if (false === $this->mediaType) {
            $entry = $this->storage->find($this->getDataIdent());
            if ($entry->webMediasId->mediaType) {
                $this->setMediaType($entry->webMediasId->mediaType);
            } else {
                $this->setMediaType('No media type found');
            }
        }
        return $this->mediaType;
    }

    /**
     *
     * @param string $mediaType
     */
    public function setMediaType($mediaType)
    {
        $this->mediaType = $mediaType;
    }

    /**
     * form field elements
     *
     * @see \ContentinumComponents\Forms\AbstractForms::elements()
     */
    public function elements()
    {
        $imageFields = array(
            
            array(
                'spec' => array(
                    'name' => 'alt',
                    'required' => true,
                    'options' => array(
                        'label' => 'Image alternate text',
                        'deco-row' => $this->getDecorators(self::DECO_TAB_ROW),
                        'deco-error' => $this->getDecorators(self::DECO_ERROR),
                        'deco-error-msg' => 'Das Feld darf nicht leer sein ein Wert ist erforderlich'
                    ),
                    
                    'type' => 'Text',
                    'attributes' => array(
                        'required' => 'required',
                        'id' => 'alt'
                    )
                )
            ),
            
            array(
                'spec' => array(
                    'name' => 'title',
                    'required' => false,
                    'options' => array(
                        'label' => 'Image title text',
                        'deco-row' => $this->getDecorators(self::DECO_TAB_ROW),
                        'deco-error' => $this->getDecorators(self::DECO_ERROR)
                    ),
                    
                    'type' => 'Text',
                    'attributes' => array(
                        'id' => 'title'
                    )
                )
            ),
            
            array(
                'spec' => array(
                    'name' => 'caption',
                    'required' => false,
                    'options' => array(
                        'label' => 'Image signature',
                        'deco-row' => $this->getDecorators(self::DECO_TAB_ROW),
                        'deco-error' => $this->getDecorators(self::DECO_ERROR)
                    ),
                    
                    'type' => 'Text',
                    'attributes' => array(
                        'id' => 'caption'
                    )
                )
            ),
            
            array(
                'spec' => array(
                    'name' => 'description',
                    'required' => false,
                    'options' => array(
                        'label' => 'Image description',
                        'deco-row' => $this->getDecorators(self::DECO_TAB_ROW),
                        'deco-error' => $this->getDecorators(self::DECO_ERROR)
                    ),
                    
                    'type' => 'Textarea',
                    'attributes' => array(
                        'rows' => '4',
                        'id' => 'description'
                    )
                )
            ),
            
            array(
                'spec' => array(
                    'name' => 'longdescription',
                    'required' => false,
                    'options' => array(
                        'label' => 'Image long description',
                        'deco-row' => $this->getDecorators(self::DECO_TAB_ROW),
                        'deco-error' => $this->getDecorators(self::DECO_ERROR),
                        'fieldset' => array(
                            'legend' => 'Media description data',
                            'attributes' => array(
                                'id' => 'save-datas'
                            )
                        )
                    ),
                    
                    'type' => 'Text',
                    'attributes' => array(
                        'id' => 'longdescription'
                    )
                )
            ),
            
            array(
                'spec' => array(
                    'name' => 'send',
                    'options' => array(
                        'deco-abort-btn' => $this->getDecorators(self::DECO_ABORT_BTN),
                        'deco-row' => $this->getDecorators(self::DECO_TAB_ROW),
                        'fieldset' => array(
                            'legend' => 'Save Datas',
                            'attributes' => array(
                                'id' => 'save-datas'
                            )
                        )
                    ),
                    'type' => 'submit',
                    'attributes' => array(
                        'value' => 'Submit',
                        'class' => 'button small'
                    )
                )
            )
        );
        
        $fileFields = array(
            
            array(
                'spec' => array(
                    'name' => 'linkname',
                    'required' => true,
                    'options' => array(
                        'label' => 'Linkname file',
                        'deco-row' => $this->getDecorators(self::DECO_TAB_ROW),
                        'deco-error' => $this->getDecorators(self::DECO_ERROR),
                        'deco-error-msg' => 'Das Feld darf nicht leer sein ein Wert ist erforderlich'
                    ),
                    
                    'type' => 'Text',
                    'attributes' => array(
                        'required' => 'required',
                        'id' => 'linkname'
                    )
                )
            ),
            
            array(
                'spec' => array(
                    'name' => 'headline',
                    'required' => false,
                    'options' => array(
                        'label' => 'Headline',
                        'deco-row' => $this->getDecorators(self::DECO_TAB_ROW),
                        'deco-error' => $this->getDecorators(self::DECO_ERROR)
                    ),
                    
                    'type' => 'Text',
                    'attributes' => array(
                        'id' => 'headline'
                    )
                )
            ),
            
            array(
                'spec' => array(
                    'name' => 'description',
                    'required' => false,
                    'options' => array(
                        'label' => 'File description',
                        'deco-row' => $this->getDecorators(self::DECO_TAB_ROW),
                        'deco-error' => $this->getDecorators(self::DECO_ERROR),
                        'fieldset' => array(
                            'legend' => 'Media description data',
                            'attributes' => array(
                                'id' => 'save-datas'
                            )
                        )
                    ),
                    
                    'type' => 'Textarea',
                    'attributes' => array(
                        'rows' => '4',
                        'id' => 'description'
                    )
                )
            ),
            
            array(
                'spec' => array(
                    'name' => 'send',
                    'options' => array(
                        'deco-abort-btn' => $this->getDecorators(self::DECO_ABORT_BTN),
                        'deco-row' => $this->getDecorators(self::DECO_TAB_ROW),
                        'fieldset' => array(
                            'legend' => 'Save Datas',
                            'attributes' => array(
                                'id' => 'save-datas'
                            )
                        )
                    ),
                    'type' => 'submit',
                    'attributes' => array(
                        'value' => 'Submit',
                        'class' => 'button small'
                    )
                )
            )
        );
        
        switch ($this->getMediaType()) {
            case 'image/gif':
            case 'image/jpeg':
            case 'image/png':
            case "image/x-icon":
            case "image/tiff":
            case "image/bmp":
                return $imageFields;
                break;
            default:
                return $fileFields;
        }
    }

    /**
     * form input filter and validation
     *
     * @see \ContentinumComponents\Forms\AbstractForms::filter()
     */
    public function filter()
    {
        $imageFilter = array(
            'alt' => array(
                'required' => true,
                'filters' => array(
                    array(
                        'name' => 'Zend\Filter\StringTrim'
                    )
                )
            )
        );
        
        $fileFilter = array(
            'linkname' => array(
                'required' => true,
                'filters' => array(
                    array(
                        'name' => 'Zend\Filter\StringTrim'
                    )
                )
            )
        );
        
        switch ($this->getMediaType()) {
        	case 'image/gif':
        	case 'image/jpeg':
        	case 'image/png':
        	case "image/x-icon":
        	case "image/tiff":
        	case "image/bmp":
        		return $imageFilter;
        		break;
        	default:
        		return $fileFilter;
        }        
    }

    /**
     * initiation and get form
     *
     * @see \ContentinumComponents\Forms\AbstractForms::getForm()
     */
    public function getForm()
    {
        return $this->factory->createForm(array(
            'hydrator' => 'Zend\Stdlib\Hydrator\ArraySerializable',
            'elements' => $this->elements(),
            'input_filter' => $this->filter()
        ));
    }
}