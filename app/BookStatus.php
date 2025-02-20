<?php

namespace App;

enum BookStatus :string
{



    case Active ='active';
    case  Deactive='deactive';

    public static function types(): array
    {
        return [self::Active, self::Deactive];
    }

}
