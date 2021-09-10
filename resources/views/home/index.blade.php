@extends('layouts.app',
[
    'styles' => ['home']
])

@section('content')
@include('home.section-1')
@include('home.section-2')
@include('home.section-3')
@include('home.section-4')
<script>
const sections = document.getElementsByClassName('section')

document.addEventListener('scroll', () => {

  const scrollPos = window.scrollY


  Array.from(sections).forEach((section) => {

    let top = parseInt(section.offsetTop);
    let height = parseInt(section.offsetHeight);

    if (
      top <= scrollPos + height /1.5 &&
      top + height > scrollPos + height / 1.5 &&
      section.children[0].classList.contains("hide")
    ) {
      section.children[0].classList.remove("hide");
    }
  });

})
</script>
@endsection
