<?php namespace App\Trinata\Src;

class Trinata
{
	public function __construct()
	{
		$this->backendUrl = config('trinata.backendUrl');
		$this->backendName = config('trinata.backendName');
	}
	
	public function hello()
	{
		return 'TRINATA';
	}

	public function user()
	{
		return getUser();
	}

	public function config($config)
	{
		return config('trinata.'.$config);
	}

	public function buttonUpdate($params)
	{
		if($this->right('update') == 'true')
		{
			$url = urlBackendAction('update/'.$params);
			
			return '<a href = "'.$url.'" class = "btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>';	
		}
	}

	public function buttonDelete($params)
	{	
		if($this->right('delete') == 'true')
		{
			$url = urlBackendAction('delete/'.$params);
			
			return '<a href = "'.$url.'" class = "btn btn-danger btn-sm" onclick = "return confirm(\'Are You sure want to delete this data?\')"><i class="fa fa-trash"></i></a>';	
		}
	}

	public function buttonView($params)
	{
		if($this->right('view') == 'true')
		{
			$url = urlBackendAction('view/'.$params);
			
			return '<a href = "'.$url.'" class = "btn btn-warning btn-sm"><i class="fa fa-search"></i></a>';	
		}
	}

	public function buttonCreate($params="")
	{
		if($this->right('create') == 'true')
		{

			$url = urlBackendAction('create/'.$params);
			return '<a href = "'.$url.'" class = "btn btn-info btn-3d"><i class="fa fa-plus"></i> Tambah</a>';
		}
	}

	public function buttonPublish($params,$status = true)
	{
		if($this->right('publish') == 'true')
		{
			$url = urlBackendAction('publish/'.$params);
			$active =  '<a onclick = "return confirm(\'are you sure want to un publish this data ?\')" href = "'.$url.'" class = "btn btn-default btn-sm"><i class="fa fa-eye-open"></i></a>';
			$notActive =  '<a onclick = "return confirm(\'are you sure want to  publish this data ?\')" href = "'.$url.'" class = "btn btn-default btn-sm"><i class="fa fa-eye-close"></i></a>';
			
			if($status == true)
			{
				return $active;
			}else{
				return $notActive;
			}
		}
	}

	public function buttonApprove($params,$status = true)
	{
		if($this->right('publish') == 'true')
		{
			$url = urlBackendAction('publish/'.$params);
			// $active =  '<a onclick = "return confirm(\'are you sure want to un publish this data ?\')" href = "'.$url.'" class = "btn btn-default btn-sm"><i class="fa fa-eye-open"></i></a>';
			// $notActive =  '<a onclick = "return confirm(\'are you sure want to  publish this data ?\')" href = "'.$url.'" class = "btn btn-default btn-sm"><i class="fa fa-eye-close"></i></a>';
			
			$active = '<label for="switcher-rounded" class="switcher switcher-primary">&nbsp;
              <input type="checkbox" id="switcher-rounded" class="editData">
              <div class="switcher-indicator">
                <div class="switcher-yes" onclick = "return moderation()">Yes</div>
                <div class="switcher-no" onclick = "return confirm(\'are you sure want to  unpublish this data ?\')">No</div>
              </div>
            </label>';

			if($status == true)
			{
				return $active;
			}else{
				return $notActive;
			}
		}
	}

	public function buttons($id , $array = [] , $status = false)
	{
		($array == []) ? $array = ['update','view','delete','publish'] : $array = $array;

		$str = "";

		foreach($array as $button)
		{
			if($button == 'update')
			{
			
				$str .= $this->buttonUpdate($id).' ';
			
			}elseif($button == 'view'){
				
				$str .= $this->buttonView($id).' ';
			
			}elseif($button == 'delete'){
				
				$str .= $this->buttonDelete($id).' ';

			}elseif($button == 'publish'){
				

				// $str .= $this->buttonPublish($id,$status).' ';
			
			}
		}

		return $str;
	}

	public function getMenu()
	{
		$permalink = \Request::segment(2);

		$model = injectModel('Menu')->whereSlug($permalink)->first();
		
		return $model;
	}

	public function getListMenu()
	{
		$ignoreMenu = ['development', 'media-library'];
		
		if (getUser()->username != 'trinata') {
			$model = injectModel('Menu')->whereParentId(null)->orderBy('order','asc')->whereNotIn('slug',$ignoreMenu)->get();
		} else {
			$model = injectModel('Menu')->whereParentId(null)->orderBy('order','asc')->get();
		}
		
		return $model;
	}

	public function getAction($slug = "")
	{
		if(!empty($slug))
		{
			$slug = $slug;
		}else{
			$slug = \Request::segment(3);
		}

		$model = injectModel('Action')->whereSlug($slug)->first();

		if(!empty($model->id))
		{
			return $model;
		}else{
			return injectModel('Action');
		}
			
	}

	public function titleActionForm()
	{	
		$actions = $this->getAction();

		$title =  $actions->title.' '.$this->getMenu()->title;

		return $title;
	}

	public function right($action = "")
	{

		if(!empty($action))
		{
			$action = $action;
		}else{
			$action = \Request::segment(3);
		}

		$menu = $this->getMenu();

		if($menu->slug == 'dashboard')
		{
			return 'true';
		}else{
			$modelAction = $this->getAction($action);

			if(!empty($modelAction->id))
			{
				$role = injectModel('Role')->find(getUser()->role_id);

				$right = $role->menu_actions()->whereMenuId($menu->id)->whereActionId($modelAction->id)->first();

				if(!empty($right->id))
				{
					return 'true';
				}else{
					return 'false';
				}
			}else{
				return 'true';
			}
				
		}
		
	}

	public function addMenu($data = [],$actions=[])
	{	
		\DB::beginTransaction();
		try
		{
			$model = injectModel('Menu');
			
			$cek = $model->whereSlug($data['slug'])->first();

			if($data['parent_id'] != null)
			{
				$parent = $model->whereSlug($data['parent_id'])->first();
				$data['parent_id'] = $parent->id;
			}

			if(empty($cek->id))
			{
				$save = $model->create($data);

				$action = injectModel('Action');
				
				$menuAction = injectModel('MenuAction');

				$right = injectModel('Right');

				foreach($actions as $row)
				{
					$cekAction = $action->whereSlug($row)->first();

					if(!empty($cekAction->id))
					{
						$menuActionSave = $menuAction->create([
							'menu_id'		=> $save->id,
							'action_id'		=> $cekAction->id,
						]);

						$right->create([
							'role_id'			=> 1,
							'menu_action_id'	=> $menuActionSave->id,
						]);
					}
				}

			}

			\DB::commit();
		
		}catch(\Exception $e){
			\DB::rollback();
			echo "menu gagal disimpan : ".$e->getMessage();
		}

	}

	public function updateMenu($data = [],$actions=[])
	{
		$model = injectModel('Menu');
		
		if($data['parent_id'] != null)
		{
			$parent = $model->whereSlug($data['parent_id'])->first();
			$data['parent_id'] = $parent->id;
		}

		//$parent = $model->whereSlug($data['parent_id'])->first();
		
		$update = $model->whereSlug($data['slug'])->first();

		//$data['parent_id'] = $parent->id;

		$update->update($data);

		$action = injectModel('Action');
			
		$menuAction = injectModel('MenuAction');

		$right = injectModel('Right');

		\DB::table('menu_actions')->where('menu_id',$update->id)->delete();

		foreach($actions as $row)
		{
			$cekAction = $action->whereSlug($row)->first();

			if(!empty($cekAction->id))
			{
				$menuActionSave = $menuAction->create([
					'menu_id'		=> $update->id,
					'action_id'		=> $cekAction->id,
				]);
				
				$right->create([
					'role_id'			=> 1,
					'menu_action_id'	=> $menuActionSave->id,
				]);
			}
		}

	}

	public function deleteMenu($slug)
	{
		$model = injectModel('Menu')->whereSlug($slug)->first()->delete();
	}

	public function handleUpload($request,$model)
    {
       $image = $request->file('image');

        if(!empty($image))
        {
             if(!empty($model->image))
                {
                    @unlink(public_path('contents/'.$model->image));
                }

            $imageName = randomImage().'.'.$image->getClientOriginalExtension();

            \Image::make($image)->save(public_path('contents/'.$imageName));

            return $imageName;
        }else{

            return $model->image;
        }
    }

    public function globalUpload($request, $tmpname=false, $customPath=false, $sourceServer=false, $typefile=false, $dimension=false)
	{
		ini_set('memory_limit', '-1');
		
		if ($customPath) $folderPath = public_path('contents'). '/'.$customPath."/" ;
		else $folderPath = public_path('contents/file'). "/" ;
		
		if (!\File::isDirectory($folderPath)) \File::makeDirectory($folderPath, 0775, true);
		
		if ($sourceServer) {
			$tmpPath =  public_path() . str_replace("%20", " ", $request->image);
			$ext = pathinfo($tmpPath, PATHINFO_EXTENSION);
			$filename = ($tmpname) ? $tmpname . '.' .$ext : 'ori-'.rand() . ".".$ext ;
			\File::copy($tmpPath, $folderPath . "/" . 'ori-'.rand());
		} else {
			
			if ($typefile =='image') {
				
				$thumbnail = $folderPath . 'preview/';
				if (!\File::isDirectory($thumbnail)) \File::makeDirectory($thumbnail, 0775, true);
				$image = $request->file($tmpname);
				$filename = rand(1,1000) . '-'. str_replace(' ', '_', $image->getClientOriginalName());
				
				if (is_array($dimension)) {
					
					\Image::make($image)->resize($dimension['width'], $dimension['height'])->save($thumbnail. '/' .$filename);

				} else {
					\Image::make($image)->resize(300, 300)->save($thumbnail. '/' .$filename);
				}
				
			} else {
				$file = $request->file($tmpname);
				$filename = rand(1,1000) . '-'. str_replace(' ', '_', $file->getClientOriginalName());
				$saveFile = $request->file($tmpname)->move($folderPath, $filename);
			}
			
		}
		
		return array('filename'=>$filename);
		
	}

	public function validateDate($date=false)
	{
		if (!$date) return false;

		try {
			$date_format = \Carbon\Carbon::createFromFormat('d/m/Y', $date);
			return true;
		} catch (\Exception $e) {
			return false;
		}

		return false;
	}

}