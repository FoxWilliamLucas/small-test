<?php
namespace App\Repositories\Eloquent;

use Exception;
use App\Helpers\{Constants, Converter};
use App\Repositories\Interfaces\IRepo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Container as Application;



abstract class BaseRepo implements IRepo {

    /**
     * @var Application
     */
    protected $app;

    /**
     * @var Model
     */
    protected $model;

    /**
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    /**
     * @param array $columns
     * 
     * @return mixed
     */
    public function paginate($columns = ['*'], $query = null){
        //parameters handling
        $order_by = request(Constants::ORDER_BY, null);
        $order_by_direction = request(Constants::ORDER_BY_DIRECTION, "asc");
        $filter_operator = request(Constants::FILTER_OPERATOR, '=');
        $filters = request(Constants::FILTERS, []);
        $per_page = request(Constants::PER_PAGE, 15);

        $query = $query??$this->model;
        $query = $query->filter($filters, $filter_operator);
        if (isset($order_by)) 
            $query = $query->orderBy($order_by, $order_by_direction);
        return $query->paginate($per_page, $columns);
    }

    /**
     * @param array $columns
     * 
     * @return mixed
     */
    public function get($columns = ['*'], $query = null){
        $query = $query??$this->model;
        return $query->get($columns);
    }

    /**
     * @param array $data
     * 
     * @return mixed
     */
    public function create(array $data){
        $customData = [];
        foreach ($this->model->getFillable() as $var)
            if(isset($data[Converter::fromSnakeToCamel($var)]))
                $customData[$var] = $data[Converter::fromSnakeToCamel($var)];
        return $this->model->create($customData);
    }

    /**
     * @param array $data
     * @param mixed $id
     * @param string $attribute
     * 
     * @return mixed
     */
    public function update(array $data, $id, $attribute = 'id'){
        $customData = [];
        foreach ($this->model->getFillable() as $var)
            if(isset($data[Converter::fromSnakeToCamel($var)]))
                $customData[$var] = $data[Converter::fromSnakeToCamel($var)];
        return $this->model->where($attribute, '=', $id)->update($customData);
    }

    /**
     * @param $id
     * 
     * @return mixed
     */
    public function delete($id){
        return $this->model->destroy($id);
    }

    /**
     * @param mixed $id
     * @param array $columns
     * 
     * @return mixed
     */
    public function find($id, $columns = ['*']){
        return $this->model->find($id , $columns);
    }

    /**
     * @param mixed $attribute
     * @param mixed $value
     * @param array $columns
     * 
     * @return mixed
     */
    public function findBy($attribute ,$value, $columns = ['*']){
        if (in_array($attribute,$this->model->getFillable()))
            return $this->model->where($attribute,'=',$value)->get();
    }

    /**
     * @param array $data
     * 
     * @return mixed
     * 
     * insert multiple rows by one query
     */
    public function insert($data){
        $customData = [];
        foreach ($this->model->getFillable() as $var){
            foreach($data as $key =>$item){
                if(isset($item[Converter::fromSnakeToCamel($var)]))
                    $customData[$key][$var] = $item[Converter::fromSnakeToCamel($var)];
            }
        }
        return $this->model->insert($customData);
    }

    /**
     * @param array $array
     * 
     * @return mixed
     */
    public function load($model, $array){
        $model->load($array);
    }

    /**
     * Set the repository model.
     *
     * @return Model
     * @throws RepositoryException
     */
    public function makeModel()
    {
        $model = $this->app->make($this->model());
        if (!$model instanceof Model) {
            throw new Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }
        return $this->model = $model;
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    abstract public function model();
}