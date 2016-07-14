<?php
namespace App\Models;

use Cache;

class Region extends Model
{

    protected $table = 'region';

    const PROVINCE_TYPE = 0;
    const CITY_TYPE = 1;
    const AREA_TYPE = 2;

    public function getAll()
    {
        if ($region = Cache::get('region')) {
            return $region;
        }
        $result = $this->loopFormat(self::all());
        Cache::forever('region', $result);
        return $region;
    }

    public function getProvinces()
    {
        return $this->getByPid(0, 0);
    }

    public function getCities($pid)
    {
        return $this->getByPid($pid, 1);
    }

    public function getAreas($pid)
    {
        return $this->getByPid($pid, 2);
    }

    public function getOne($id, $type = null, $filed = null)
    {
        $all = $this->getAll();
        if (isset($all[$id])) {
            if (is_null($type)) {
                return is_null($filed) ? $all[$id] : (isset($all[$id][$filed]) ? $all[$id][$filed] : $all[$id]);
            } elseif ($all[$id]['type'] == $type) {
                return is_null($filed) ? $all[$id] : (isset($all[$id][$filed]) ? $all[$id][$filed] : $all[$id]);
            }
        }
        return null;
    }

    protected function getByType($type = self::PROVINCE_TYPE)
    {
        $key = 'region_type_' . $type;
        if ($province = Cache::get($key)) {
            return $province;
        }
        $all = self::where('type', $type)->get();
        if (!$all) {
            return array();
        }
        $result = $this->loopFormat($all);
        Cache::forever($key, $result);
        return $result;
    }

    public function getByPid($pid, $type)
    {
        $key = 'region_pid_' . $pid;
        if ($region = Cache::get($key)) {
            return $region;
        }
        $all = self::whereRaw('pid = ? and type = ? ', array($pid, $type))->get();
        if ($all->count() <= 0) {
            return array();
        }
        $result = $this->loopFormat($all);
        Cache::forever($key, $result);
        return $result;
    }

    private function loopFormat($ret)
    {
        $result = array();
        if ($ret) foreach ($ret as $key => $val) {
            $result[$val->id] = array(
                'id' => $val->id,
                'type' => $val->type,
                'pid' => $val->pid,
                'name' => $val->name
            );
        }
        return $result;
    }

}
