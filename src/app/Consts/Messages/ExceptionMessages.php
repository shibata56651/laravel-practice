<?php

namespace App\Consts\Messages;

class ExceptionMessages
{
    public const PROPERTY_DOES_NOT_EXISTS = '指定されたプロパティは存在しません。';

    public const MISSING_REQUIRED_PARAMETER = '必須のパラメータが不足しています。';

    public const IDTOKEN_EXPIRATION_MESSAGE = 'idTokenの有効期限が切れています';

    public const IDTOKEN_NOT_FOUND = 'idTokenが見つかりません。';

    public const INVALID_IDTOKEN_FORMAT = '無効なidTokenの形式です。';

    public const EXPIRATION_NOT_FOUND = 'トークンの有効期限が見つかりません。';

    public const DATA_DOES_NOT_EXIST = '情報は存在しません。';

    public const DATABASE_FAILED = 'データベースの処理に失敗しました。';

    public const LINE_LOGIN_FAILED = 'LINEログインに失敗しました。';

    public const IDTOKEN_VERIFICATION_FAILED = 'idTokenの検証に失敗しました。';

    public const VERIFY_JWT_DECODE_FAILED = 'JWTのデコードに失敗しました。';

    public const S3_FAILED = 'S3の処理に失敗しました。';

    public const SYSTEM_ERROR = 'システムエラーが発生しました。';
}
