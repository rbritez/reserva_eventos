<?php

return [

    /*
    |-----------------------------------------------------------------------
    | Líneas de idioma para validación
    |-----------------------------------------------------------------------
    |
    | Las siguientes líneas contienen los mensajes de error predeterminados
    | utilizados por la clase validadora. Siéntete libre de modificar
    | cada uno de estos mensajes aquí.
    |
    */

    'accepted' => 'Debes aceptar el campo :attribute.',
    'accepted_if' => 'Debes aceptar el campo :attribute cuando :other es :value.',
    'active_url' => 'El campo :attribute no es una URL válida.',
    'after' => 'La fecha en :attribute debe ser posterior a :date.',
    'after_or_equal' => 'La fecha en :attribute debe ser posterior o igual a :date.',
    'alpha' => 'El campo :attribute solo puede contener letras.',
    'alpha_dash' => 'El campo :attribute solo puede contener letras, números, guiones y guiones bajos.',
    'alpha_num' => 'El campo :attribute solo puede contener letras y números.',
    'array' => 'El campo :attribute debe ser un array.',
    'ascii' => 'El campo :attribute solo puede contener caracteres alfanuméricos y símbolos de un solo byte.',
    'before' => 'La fecha en :attribute debe ser anterior a :date.',
    'before_or_equal' => 'La fecha en :attribute debe ser anterior o igual a :date.',
    'between' => [
        'array' => 'El campo :attribute debe tener entre :min y :max elementos.',
        'file' => 'El tamaño de :attribute debe estar entre :min y :max kilobytes.',
        'numeric' => 'El valor de :attribute debe estar entre :min y :max.',
        'string' => 'El campo :attribute debe tener entre :min y :max caracteres.',
    ],
    'boolean' => 'El campo :attribute debe ser verdadero o falso.',
    'confirmed' => 'La confirmación de :attribute no coincide.',
    'current_password' => 'La contraseña es incorrecta.',
    'date' => 'El campo :attribute no es una fecha válida.',
    'date_equals' => 'El campo :attribute debe ser una fecha igual a :date.',
    'date_format' => 'El campo :attribute no coincide con el formato :format.',
    'decimal' => 'El campo :attribute debe tener :decimal decimales.',
    'declined' => 'Debes rechazar el campo :attribute.',
    'declined_if' => 'Debes rechazar el campo :attribute cuando :other es :value.',
    'different' => 'Los campos :attribute y :other deben ser diferentes.',
    'digits' => 'El campo :attribute debe tener :digits dígitos.',
    'digits_between' => 'El campo :attribute debe tener entre :min y :max dígitos.',
    'dimensions' => 'Las dimensiones de la imagen :attribute son inválidas.',
    'distinct' => 'El campo :attribute tiene un valor duplicado.',
    'doesnt_end_with' => 'El campo :attribute no puede terminar con uno de los siguientes: :values.',
    'doesnt_start_with' => 'El campo :attribute no puede empezar con uno de los siguientes: :values.',
    'email' => 'El campo :attribute debe ser una dirección de correo electrónico válida.',
    'ends_with' => 'El campo :attribute debe terminar con uno de los siguientes: :values.',
    'enum' => 'El :attribute seleccionado no es válido.',
    'exists' => 'El :attribute seleccionado no es válido.',
    'file' => 'El campo :attribute debe ser un archivo.',
    'filled' => 'El campo :attribute debe tener un valor.',
    'gt' => [
        'array' => 'El campo :attribute debe tener más de :value elementos.',
        'file' => 'El tamaño de :attribute debe ser mayor que :value kilobytes.',
        'numeric' => 'El valor de :attribute debe ser mayor que :value.',
        'string' => 'El campo :attribute debe tener más de :value caracteres.',
    ],
    'gte' => [
        'array' => 'El campo :attribute debe tener :value elementos o más.',
        'file' => 'El tamaño de :attribute debe ser mayor o igual a :value kilobytes.',
        'numeric' => 'El valor de :attribute debe ser mayor o igual a :value.',
        'string' => 'El campo :attribute debe tener como mínimo :value caracteres.',
    ],
    'image' => 'El campo :attribute debe ser una imagen.',
    'in' => 'El :attribute seleccionado no es válido.',
    'in_array' => 'El campo :attribute no existe en :other.',
    'integer' => 'El campo :attribute debe ser un número entero.',
    'ip' => 'El campo :attribute debe ser una dirección IP válida.',
    'ipv4' => 'El campo :attribute debe ser una dirección IPv4 válida.',
    'ipv6' => 'El campo :attribute debe ser una dirección IPv6 válida.',
    'json' => 'El campo :attribute debe ser una cadena JSON válida.',
    'lowercase' => 'El campo :attribute debe estar en minúsculas.',
    'lt' => [
        'array' => 'El campo :attribute debe tener menos de :value elementos.',
        'file' => 'El tamaño de :attribute debe ser menor que :value kilobytes.',
        'numeric' => 'El valor de :attribute debe ser menor que :value.',
        'string' => 'El campo :attribute debe tener menos de :value caracteres.',
    ],
    'lte' => [
        'array' => 'El campo :attribute no debe tener más de :value elementos.',
        'file' => 'El tamaño de :attribute debe ser menor o igual a :value kilobytes.',
        'numeric' => 'El valor de :attribute debe ser menor o igual a :value.',
        'string' => 'El campo :attribute debe tener como máximo :value caracteres.',
    ],
    'mac_address' => 'El campo :attribute debe ser una dirección MAC válida.',
    'max' => [
        'array' => 'El campo :attribute no debe tener más de :max elementos.',
        'file' => 'El tamaño de :attribute no debe ser mayor a :max kilobytes.',
        'numeric' => 'El valor de :attribute no debe ser mayor a :max.',
        'string' => 'El campo :attribute no debe tener más de :max caracteres.',
    ],
    'max_digits' => 'El campo :attribute no debe tener más de :max dígitos.',
    'mimes' => 'El campo :attribute debe ser un archivo de tipo: :values.',
    'mimetypes' => 'El campo :attribute debe ser un archivo de tipo: :values.',
    'min' => [
        'array' => 'El campo :attribute debe tener al menos :min elementos.',
        'file' => 'El tamaño de :attribute debe ser al menos :min kilobytes.',
        'numeric' => 'El valor de :attribute debe ser al menos :min.',
        'string' => 'El campo :attribute debe tener al menos :min caracteres.',
    ],
    'min_digits' => 'El campo :attribute debe tener al menos :min dígitos.',
    'missing' => 'El campo :attribute debe estar ausente.',
    'missing_if' => 'El campo :attribute debe estar ausente cuando :other es :value.',
    'missing_unless' => 'El campo :attribute debe estar ausente a menos que :other esté en :values.',
    'missing_with' => 'El campo :attribute debe estar ausente cuando :values está presente.',
    'missing_with_all' => 'El campo :attribute debe estar ausente cuando :values están presentes.',
    'multiple_of' => 'El campo :attribute debe ser un múltiplo de :value.',
    'not_in' => 'El :attribute seleccionado no es válido.',
    'not_regex' => 'El formato de :attribute es inválido.',
    'numeric' => 'El campo :attribute debe ser un número.',
    'password' => [
        'letters' => 'La :attribute debe contener al menos una letra.',
        'mixed' => 'La :attribute debe contener al menos una letra mayúscula y una minúscula.',
        'numbers' => 'La :attribute debe contener al menos un número.',
        'symbols' => 'La :attribute debe contener al menos un símbolo.',
        'uncompromised' => 'La :attribute proporcionada ha aparecido en una filtración de datos. Por favor, elige una diferente.',
    ],
    'present' => 'El campo :attribute debe estar presente.',
    'prohibited' => 'El campo :attribute está prohibido.',
    'prohibited_if' => 'El campo :attribute está prohibido cuando :other es :value.',
    'prohibited_unless' => 'El campo :attribute está prohibido a menos que :other esté en :values.',
    'prohibits' => 'El campo :attribute prohíbe que :other esté presente.',
    'regex' => 'El formato de :attribute es inválido.',
    'required' => 'El campo :attribute es obligatorio.',
    'required_array_keys' => 'El campo :attribute debe contener entradas para: :values.',
    'required_if' => 'El campo :attribute es obligatorio cuando :other es :value.',
    'required_if_accepted' => 'El campo :attribute es obligatorio cuando :other es aceptado.',
    'required_unless' => 'El campo :attribute es obligatorio a menos que :other esté en :values.',
    'required_with' => 'El campo :attribute es obligatorio cuando :values está presente.',
    'required_with_all' => 'El campo :attribute es obligatorio cuando :values están presentes.',
    'required_without' => 'El campo :attribute es obligatorio cuando :values no está presente.',
    'required_without_all' => 'El campo :attribute es obligatorio cuando ninguno de :values está presente.',
    'same' => 'Los campos :attribute y :other deben coincidir.',
    'size' => [
        'array' => 'El campo :attribute debe contener :size elementos.',
        'file' => 'El tamaño de :attribute debe ser :size kilobytes.',
        'numeric' => 'El valor de :attribute debe ser :size.',
        'string' => 'El campo :attribute debe tener :size caracteres.',
    ],
    'starts_with' => 'El campo :attribute debe comenzar con uno de los siguientes: :values.',
    'string' => 'El campo :attribute debe ser una cadena de texto.',
    'timezone' => 'El campo :attribute debe ser una zona horaria válida.',
    'unique' => 'El :attribute ya está en uso.',
    'uploaded' => 'El campo :attribute no se pudo subir.',
    'uppercase' => 'El campo :attribute debe estar en mayúsculas.',
    'url' => 'El campo :attribute debe ser una URL válida.',
    'ulid' => 'El campo :attribute debe ser un ULID válido.',
    'uuid' => 'El campo :attribute debe ser un UUID válido.',

    /*
    |-----------------------------------------------------------------------
    | Líneas de idioma para validación personalizadas
    |-----------------------------------------------------------------------
    |
    | Aquí puedes especificar mensajes de validación personalizados para
    | atributos utilizando la convención "attribute.rule" para nombrar
    | las líneas. Esto hace que sea rápido especificar un mensaje
    | específico para una regla de atributo dada.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |-----------------------------------------------------------------------
    | Atributos de validación personalizados
    |-----------------------------------------------------------------------
    |
    | Las siguientes líneas se utilizan para intercambiar nuestro marcador
    | de atributo por algo más amigable como "Dirección de Correo"
    | en lugar de "email". Esto simplemente ayuda a hacer que nuestros
    | mensajes sean más expresivos.
    |
    */

    'attributes' => [],

];
