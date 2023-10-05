<a class='editElementorButton bs-tooltip text-success m-auto' data-toggle='modal' data-target='#editElementorModal'
    data-name-en="{{ $query->getTranslation('name','en') }}"
    data-name-ar="{{ $query->getTranslation('name','ar') }}"
    data-desc-en="{{ $query->getTranslation('desc','en') }}"
    data-desc-ar="{{ $query->getTranslation('desc','ar') }}"
    data-href="{{ route('admin.elementor.update', $query->id) }}">


    <i class='icon fa-solid fa-pen-to-square fa-xl'></i>

    
</a>
