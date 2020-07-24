<?php


namespace App\Helper;


use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

class CustomController extends Controller
{

    protected $model;

    protected $validationRules = [];

    protected $validationMessage = [];

    /** @var Request $request */
    protected $request;

    /**
     * CustomController constructor.
     */
    public function __construct()
    {
        $this->request = Request::createFromGlobals();
    }


    public function insert($class = null, $data = [])
    {
        $model = new $class();
        foreach ($data as $key => $d) {
            $model[$key] = $data[$key];
        }
        return $model->save() ? $model : false;
    }

    public function update($class = null, $data = [])
    {
        $id = $this->request->request->get('id');
        $model = $class::find($id);
        foreach ($data as $key => $d) {
            $model[$key] = $data[$key];
        }
        return $model->save() ? $model : false;
    }

    public function customUpdate($model = null, $data = [])
    {
        foreach ($data as $key => $d) {
            $model[$key] = $data[$key];
        }
        return $model->save() ? $model : false;
    }

    public function directInsert($class = null, $data = [])
    {
        $model = new $class();
        foreach ($data as $key => $d) {
            $model[$key] = $data[$key];
        }
        $model->save();
        return $model;
    }

    public function directUpdate($class = null, $id = 1, $data = [])
    {
        $model = $class::find($id);
        foreach ($data as $key => $d) {
            $model[$key] = $data[$key];
        }
        $model->save();
        return $model;
    }

    public function generateImageName($field = '')
    {
        $value = '';
        if ($this->request->hasFile($field)) {
            $files = $this->request->file($field);
            $extension = $files->getClientOriginalExtension();
            $name = $this->uuidGenerator();
            $value = $name . '.' . $extension;
        }
        return $value;
    }

    //disk setting on app/config/filesystem
    public function uploadImage($field, $targetName = '', $disk = 'upload')
    {
        $file = $this->request->file($field);
        return Storage::disk($disk)->put($targetName, File::get($file));
    }

    public function uuidGenerator()
    {
        return Uuid::uuid1()->toString();
    }

    public function checkValidation(Request $request)
    {
        $data = $request->all();
        return Validator::make($data, $this->getValidationRules(), $this->getValidationMessage());
    }

    public function isAuth($credentials = [])
    {
        if (count($credentials) > 0 && Auth::attempt($credentials)) {
            return true;
        }
        return false;
    }

    /**
     * @return mixed
     */
    public function getValidationRules()
    {
        return $this->validationRules;
    }

    /**
     * @param mixed $validationRules
     * @return CustomController
     */
    public function setValidationRules($validationRules)
    {
        $this->validationRules = $validationRules;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValidationMessage()
    {
        return $this->validationMessage;
    }

    /**
     * @param mixed $validationMessage
     * @return CustomController
     */
    public function setValidationMessage($validationMessage)
    {
        $this->validationMessage = $validationMessage;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param mixed $model
     * @return CustomController
     */
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

    public function postField($key)
    {
        return $this->request->request->get($key);
    }

    public function field($key)
    {
        return $this->request->query->get($key);
    }

    public function jsonResponse($data = '', $status = 200){
        return response()->json([
            'status' => $status,
            'payload' => $data
        ], $status);
    }
}
