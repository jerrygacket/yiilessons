<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 29.04.19
 * Time: 11:48
 */

interface RepositoryInterface
{
    public function createElement($element = []):bool;

    public function updateElement($element):bool;

    public function getElementById($id);

    public function getOne($where = ['id'=>1]);

    public function getMany($where = ['id'=>1]);

    public function deleteElement($id);
}