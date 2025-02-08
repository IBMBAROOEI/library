<?php

namespace App;

enum BookStatus :string
{
    


    case Active ='active';
    case  Deactive='deactive';


    public static function types(): array{
        return  array_map(fn($case)=>

 $case->value, self::cases());
    }

}
