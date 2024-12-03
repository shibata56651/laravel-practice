<?php

namespace Tests\Unit;

use App\Domain\Entities\Admin;
use PHPUnit\Framework\TestCase;
use ReflectionMethod;
use UnexpectedValueException;

class AdminTest extends TestCase
{
    /**
     * @test
     */
    public function test_getProperty_idを指定したときに1が返却されること()
    {
        $admin_data = [
            'id' => 1,
            'name' => 'BG',
        ];

        $admin = new Admin($admin_data);

        $id = $admin->getProperty('id');

        $this->assertSame(1, $id);
    }

    /**
     * @test
     */
    public function test_getProperty_nameを指定したときにBGが返却されること()
    {
        $admin_data = [
            'id' => 1,
            'name' => 'BG',
        ];

        $admin = new Admin($admin_data);

        $name = $admin->getProperty('name');

        $this->assertSame('BG', $name);

    }

    /**
     * @test
     */
    public function test_getProperty_指定されたpropertyが存在しないときにエラー文が返却されること()
    {
        $admin_data = [
            'id' => 1,
            'name' => 'BG',
        ];

        $this->expectException(UnexpectedValueException::class);

        $this->expectExceptionCode(0);

        $this->expectExceptionMessage('指定されたプロパティは存在しません。');

        $admin = new Admin($admin_data);

        $admin->getProperty('tell');
    }

    /**
     * @test
     */
    public function test_setProperty_必須パラメータが充足している時に処理を実行すること()
    {
        $admin_data = [
            'id' => 1,
            'name' => 'BG',
        ];

        $admin = new Admin($admin_data);

        $method = new ReflectionMethod(get_class($admin), 'setProperty');

        $method->setAccessible(true);

        $method->invoke($admin, [
            'id' => 2,
            'name' => 'BG2',
        ]);

        $this->assertSame('BG2', $admin->getProperty('name'));

        $this->assertSame(2, $admin->getProperty('id'));
    }

    /**
     * @test
     */
    public function test_setProperty_必須パラメータが不足している時にエラー文を返却すること()
    {

        $admin_data = [
            'id' => 1,
        ];

        $this->expectException(UnexpectedValueException::class);

        $this->expectExceptionCode(0);

        $this->expectExceptionMessage('必須のパラメータが不足しています。');

        $admin = new Admin($admin_data);

        $method = new ReflectionMethod(get_class($admin), 'setProperty');

        $method->setAccessible(true);

        $method->invoke($admin, $admin_data);
    }

    public function test_setProperty_必須パラメータ以外のパラメータが存在しているときに処理を実行すること()
    {
        $admin_data = [
            'id' => 1,
            'name' => 'BG',
            'tell' => 000 - 0000 - 0000,
        ];

        $admin = new Admin($admin_data);

        $method = new ReflectionMethod(get_class($admin), 'setProperty');

        $method->setAccessible(true);

        $method->invoke($admin, [
            'id' => 2,
            'name' => 'BG2',
        ]);

        $this->assertSame('BG2', $admin->getProperty('name'));

        $this->assertSame(2, $admin->getProperty('id'));
    }
}
