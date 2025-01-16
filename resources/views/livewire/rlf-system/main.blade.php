@section('page-script')
    <script>
        //document.title = 'Форма входа в систему | Панель управления контентом';
        window.addEventListener('titleChange', event => {
            document.title = event.detail.title;
        });
    </script>
@endsection
<div class="auth-main">

         <livewire:dynamic-component :component="$this->action" :key="$this->action"/>
</div>