@extends('layouts.prevenir-master')
@section('content')


    <div class="row pb-5">

        <!-- Article Body -->
        <article class="art001 col-lg-8 offset-lg-2 border-0">
            @include('components.cpt004', [
                'extraClasses' => 'cpt004--center margin-bottom',
                'barTitle' => 'política de privacidade',
            ])
            <p class="art001-body__text playfair playfair--e10">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam lectus felis, pulvinar           sed ultricies a, tempor vel tortor. Suspendisse potenti. Sed eget orci nec tellus pretium tincidunt. Integer pellentesque sit amet lectus non accumsan. Proin non purus ante. Phasellus vitae congue mi. Fusce laoreet feugiat felis, rutrum hendrerit velit dignissim pretium. Cras lobortis tellus nisl, sit amet facilisis diam elementum vitae. In et varius nibh, eu viverra leo. Fusce at molestie diam. Duis euismod bibendum leo, id maximus nunc auctor et. Praesent blandit leo a elit semper convallis. Proin id ex felis. Vestibulum egestas eros vitae arcu tristique, ut luctus turpis mattis. Integer malesuada aliquam ornare.
            </p>
            <p class="art001-body__text playfair playfair--e10">Cras posuere facilisis erat, mattis pulvinar ante imperdiet eu. In mattis quam nec facilisis bibendum. Donec elementum sagittis turpis, a fermentum arcu ultrices nec. Aliquam congue, ipsum ac pulvinar tincidunt, sem purus scelerisque lorem, tincidunt luctus nulla est ac est. Mauris fermentum, risus vitae efficitur fringilla, dui felis fermentum erat, nec condimentum nibh tellus eget nibh. Nullam egestas nulla sed nunc bibendum dictum. Sed volutpat feugiat magna sed rutrum. Sed dolor arcu, condimentum ut neque a, semper mattis ipsum.
            </p>
            <p class="art001-body__text playfair playfair--e10">Cras posuere facilisis erat, mattis pulvinar ante imperdiet eu. In mattis quam nec facilisis bibendum. Donec elementum sagittis turpis, a fermentum arcu ultrices nec. Aliquam congue, ipsum ac pulvinar tincidunt, sem purus scelerisque lorem, tincidunt luctus nulla est ac est. Mauris fermentum, risus vitae efficitur fringilla, dui felis fermentum erat, nec condimentum nibh tellus eget nibh. Nullam egestas nulla sed nunc bibendum dictum. Sed volutpat feugiat magna sed rutrum. Sed dolor arcu, condimentum ut neque a, semper mattis ipsum.</p>
        </article>
        <!-- / Article Boyd-->


    </div>


@endsection