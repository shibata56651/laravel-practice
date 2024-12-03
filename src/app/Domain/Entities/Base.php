<?php

namespace App\Domain\Entities;

use App\Consts\Messages\ExceptionMessages;
use UnexpectedValueException;

class Base
{
    protected static array $required_params = [];

    /**
     * コンストラクタ。指定されたプロパティ以外が存在しないことを確認します。
     * プロパティの指定はEntitiesファイルで、それぞれ初期値として設定しています。
     *
     * @param  array  $data  プロパティに設定するデータの配列
     *
     * @throws UnexpectedValueException 指定されたプロパティが存在しない場合
     */
    public function __construct(array $data)
    {
        $this->setProperty($data);
    }

    /**
     * blade側で指定されたプロパティが存在すれば、その値を表示する関数
     *
     * @return mixed|false
     */
    public function getProperty(string $property_name)
    {
        if (property_exists($this, $property_name) == false) {
            throw new UnexpectedValueException(ExceptionMessages::PROPERTY_DOES_NOT_EXISTS);
        }

        return $this->{$property_name};
    }

    /**
     * 渡されたデータのプロパティを確認し、クラスのプロパティに設定する。
     *
     * @param  array  $data  データの配列
     *
     * @throws UnexpectedValueException 指定されたプロパティが存在しない場合にスローされる例外
     */
    private function setProperty(array $data)
    {
        foreach (static::$required_params as $required_param) {
            if (! array_key_exists($required_param, $data)) {
                throw new UnexpectedValueException(ExceptionMessages::MISSING_REQUIRED_PARAMETER);
            } else {
                $this->{$required_param} = $data[$required_param];
            }
        }
    }
}
