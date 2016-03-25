  public function beforeSave() {
                    if ($this->isNewRecord)
                        {
                            $arr = explode("/",$this->birthdate);
                            $this->birthdate =$arr[2].'-'.$arr[0].'-'.$arr[1];
                            $this->password = md5(substr($this->idcard, -4, 4));
                            $this->fullname = $this->fname.' '.$this->lname;
                        }
                    return parent::beforeSave();
                }