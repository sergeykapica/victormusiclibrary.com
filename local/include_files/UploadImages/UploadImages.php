<?
namespace UploadImagesContext;

class UploadImages
{
	public static function uploadToMedialib($files, $callback, $collectionId, $multiple = false, $backPage = false)
	{
		$resultCall = array();
		
		if(\count($files) > 0)
		{
			foreach($files as $kFile => $file)
			{
				if(!empty($file['name']))
				{
					
					$fileName = $file['name'];
					
					if($file['error'] == 0)
					{	
						if(\CModule::IncludeModule("fileman"))
						{
							\CMedialib::Init();
							
							$fileMimeType = $file['type'];
							$fileMimeType = \explode('/', $fileMimeType);
							$fileMimeType = \end($fileMimeType);
							
							$imageTypes = \CMedialib::GetTypes();
							$imageTypes = \explode(',', $imageTypes[0]['ext']);
							
							$fileExt = \explode('.', $fileName);
							$fileExt = \end($fileExt);
							
							$fileSize = $file['size'];
							$maxSize = \CMedialib::getMaximumFileUploadSize();
							
							if(\in_array($fileExt, $imageTypes))
							{
								if(\in_array($fileMimeType, $imageTypes))
								{
									if($fileSize <= $maxSize)
									{
										$arFields = array(
											"file" => $file,
											"path" => false,
											"arFields" => 
												Array(
													"ID" => 0,
													"NAME" => $fileName
												),
											"arCollections" => Array($collectionId)
										);

										$arItem = \CMedialibItem::Edit($arFields);
										$arItem = \CFile::MakeFileArray($arItem['PATH']);
										
										if($arItem)
										{	
											if($multiple)
											{
												$arItem['originalName'] = $file['name'];
												$resultCall[] = $callback($arItem);
											}
											else
											{
												$resultCall = $callback($arItem);
											}
											
											$aKeys = array_keys($files);
											
											if($kFile == $aKeys[count($aKeys) - 1])
											{	
												if(!$multiple)
												{
													if($backPage === false)
													{
														echo \json_encode(
															array(
																'loadDone' => \str_replace('\n', '', \trim(\htmlspecialcharsBack($resultCall)))
															)
														);
													}
													else
													{
														return array(
															'loadDone' => true
														);
													}
												}
												else
												{
													echo \json_encode(
														array(
															'loadDone' => $resultCall
														)
													);
												}
											}
										}
										else
										{
											$resultCall = 'При загрузке файла: ' . $fileName . ' возникла ошибка.';
											
											if($backPage === false)
											{
												echo \json_encode(
													array(
														'loadFailed' => $resultCall
													)
												);
												
												die();
											}
											else
											{
												return array(
													'loadFailed' => $resultCall
												);
											}
										}
									}
									else
									{
										$naturalSize = $maxSize / 1000;
										
										$resultCall = 'Файл <b>' . $fileName . '</b> превышает максимальный размер: '
										. $naturalSize . ' КБ.';
										
										if($backPage === false)
										{
											echo \json_encode(
												array(
													'loadFailed' => $resultCall
												)
											);
											
											die();
										}
										else
										{
											return array(
												'loadFailed' => $resultCall
											);
										}
									}
								}
								else
								{
									$resultCall = 'Файл содержит запрещённое расширение: ' . $fileMimeType  . '.';
								
									if($backPage === false)
									{
										echo \json_encode(
											array(
												'loadFailed' => $resultCall
											)
										);
										
										die();
									}
									else
									{
										return array(
											'loadFailed' => $resultCall
										);
									}
								}
							}
							else
							{
								$resultCall = 'Файл содержит запрещённое расширение: ' . $fileExt . '.';
								
								if($backPage === false)
								{
									echo \json_encode(
										array(
											'loadFailed' => $resultCall
										)
									);
									
									die();
								}
								else
								{
									return array(
										'loadFailed' => $resultCall
									);
								}
							}
						}
						else
						{
							$resultCall = 'При загрузке файла: ' . $fileName . ' возникла ошибка.';
							
							if($backPage === false)
							{
								echo \json_encode(
									array(
										'loadFailed' => $resultCall
									)
								);
								
								die();
							}
							else
							{
								return array(
									'loadFailed' => $resultCall
								);
							}
						}
					}
				}
				else
				{
					$resultCall = $callback();
					
					if($backPage === false)
					{
						echo \json_encode(
							array(
								'loadDone' => $resultCall
							)
						);
					}
					else
					{
						return array(
							'loadDone' => $resultCall
						);
					}
				}
			}
		}
	}
	
	public static function fileCheckForConditions($file, $backPage = false)
	{
		if(!empty($file['name']))
		{		
			$fileName = $file['name'];
			
			if($file['error'] == 0)
			{	
				if(\CModule::IncludeModule("fileman"))
				{
					\CMedialib::Init();
					
					$fileMimeType = $file['type'];
					$fileMimeType = \explode('/', $fileMimeType);
					$fileMimeType = \end($fileMimeType);
					
					$imageTypes = \CMedialib::GetTypes();
					$imageTypes = \explode(',', $imageTypes[0]['ext']);
					
					$fileExt = \explode('.', $fileName);
					$fileExt = \end($fileExt);
					
					$fileSize = $file['size'];
					$maxSize = \CMedialib::getMaximumFileUploadSize();
					
					if(\in_array($fileExt, $imageTypes))
					{
						if(\in_array($fileMimeType, $imageTypes))
						{
							if($fileSize <= $maxSize)
							{
								if($fileMimeType == 'jpeg' || $fileMimeType == 'jpg')
								{	
									imagejpeg(UploadImages::resizeUploadImage($file, $fileMimeType), $file['tmp_name']);
								}
								else if($fileMimeType == 'gif')
								{
									imagegif(UploadImages::resizeUploadImage($file, $fileMimeType), $file['tmp_name']);
								}
								else
								{
									imagepng(UploadImages::resizeUploadImage($file, $fileMimeType), $file['tmp_name']);
								}
								
								return $file;
							}
							else
							{
								$naturalSize = $maxSize / 1000;
								
								$resultCall = 'Файл <b>' . $fileName . '</b> превышает максимальный размер: '
								. $naturalSize . ' КБ.';
								
								if($backPage === false)
								{
									echo \json_encode(
										array(
											'LOAD_FAILED' => $resultCall
										)
									);
									
									die();
								}
								else
								{
									return array(
										'LOAD_FAILED' => $resultCall
									);
								}
							}
						}
						else
						{
							$resultCall = 'Файл содержит запрещённое расширение: ' . $fileMimeType  . '.';
						
							if($backPage === false)
							{
								echo \json_encode(
									array(
										'LOAD_FAILED' => $resultCall
									)
								);
								
								die();
							}
							else
							{
								return array(
									'LOAD_FAILED' => $resultCall
								);
							}
						}
					}
					else
					{
						$resultCall = 'Файл содержит запрещённое расширение: ' . $fileExt . '.';
						
						if($backPage === false)
						{
							echo \json_encode(
								array(
									'LOAD_FAILED' => $resultCall
								)
							);
							
							die();
						}
						else
						{
							return array(
								'LOAD_FAILED' => $resultCall
							);
						}
					}
				}
				else
				{
					$resultCall = 'При загрузке файла: ' . $fileName . ' возникла ошибка.';
					
					if($backPage === false)
					{
						echo \json_encode(
							array(
								'LOAD_FAILED' => $resultCall
							)
						);
						
						die();
					}
					else
					{
						return array(
							'LOAD_FAILED' => $resultCall
						);
					}
				}
			}
		}
		else
		{
			$resultCall = 'Файл отсутствует';
			
			if($backPage === false)
			{
				echo \json_encode(
					array(
						'LOAD_FAILED' => $resultCall
					)
				);
				
				die();
			}
			else
			{
				return array(
					'LOAD_FAILED' => $resultCall
				);
			}
		}
	}
	
	public static function resizeUploadImage($file, $type)
    {
        if($type == 'image/gif')
        {
            $image = imagecreatefromgif($file);
        }
        else if($type == 'image/jpeg' || $type == 'image/jpg')
        {
            $image = imagecreatefromjpeg($file);
        }
        else
        {
            $image = imagecreatefrompng($file);
        }
        
        $imageOriginalWidth = imagesx($image);
        $imageOriginalHeight = imagesy($image);
        $imageMaxWidth = 320;
        $imageMaxHeight = 240;
        $ratioW = $imageOriginalWidth / $imageMaxWidth;
        $ratioH = $imageOriginalHeight / $imageMaxHeight;
        
        $ratioCoefficient = min($ratioH, $ratioW);
        
        
        $imageMaxWithRatioWidth = round($imageOriginalWidth / $ratioCoefficient);
        $imageMaxWithRatioHeight = round($imageOriginalHeight / $ratioCoefficient);
        $outputImageWidth = $imageMaxWithRatioWidth - ( $imageMaxWithRatioWidth - $imageMaxWidth );
        $outputImageHeight = $imageMaxWithRatioHeight - ( $imageMaxWithRatioHeight - $imageMaxHeight );
        
        $offsetW = $imageMaxWithRatioWidth > $imageMaxWidth ? ( $imageMaxWithRatioWidth - $imageMaxWidth ) / 2 : 0;
        $offsetH = $imageMaxWithRatioHeight > $imageMaxHeight ? ( $imageMaxWithRatioHeight - $imageMaxHeight ) / 2 : 0;
        
        $layerWithRatio = imagecreatetruecolor($imageMaxWithRatioWidth, $imageMaxWithRatioHeight);
        $outputLayer = imagecreatetruecolor($outputImageWidth, $outputImageHeight);
        
        imagecopyresampled($layerWithRatio, $image, 0, 0, 0, 0, $imageMaxWithRatioWidth, $imageMaxWithRatioHeight, $imageOriginalWidth, $imageOriginalHeight);
        imagecopy($outputLayer, $layerWithRatio, 0, 0, $offsetW, $offsetH, $outputImageWidth, $outputImageHeight);
        
        return $outputLayer;
    }
}
?>