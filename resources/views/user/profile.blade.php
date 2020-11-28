@extends('partials.app')

@section('title')
    Profile
@stop
 
@section('content')
    @if( $flash = session('updateMessage') )
        <div class="alert alert-success">{{ $flash }}</div>
    @endif
    
       
    <div class="intro">
        <h1>{{ $users->first_name }} {{ $users->last_name }}</h1>
        @if ($users->account_type == 1 )

            <p id="education-info">Student {{ $users->education }} at {{ $users->school }} </p>
        @endif
        <div class='description'>
            <p>{{ $users->description }}</p>
        </div>
    
        <div class="container-img">
        @if (empty( $users->picture ))
            <img class="img-thumbnail" src="{{ asset('images/profilePic.jpg') }}" width="500" height="500" alt="profilepicture" id="profilePicture">
        @else
            <img class="img-thumbnail" src="{{ asset('storage/' . $users->picture) }}" width="500" height="500" alt="profilepicture" id="profilePicture">
            @endif
        </div>
    </div>
 
    <div class='contact'>
        <h4>Contact </h4>
        <div>
            <!--icon mail-->
            <p>{{ $users->email }}</p>
        </div>
        <div>
            <!--icon phone-->
            <p>{{ $users->phone_number }}</p>
        </div>     
    </div>
    
    @if (!empty( $users->cv ))
    <a href="{{ asset('storage/' . $users->cv) }}" download="cv_{{ $users->first_name }}_{{ $users->last_name }}">
        <p>Download my cv</p>
    </a>    
    @endif
    
    @if (!empty( $users->website ) || !empty( $users->linkedin ) || !empty( $users->dribbble ) || !empty( $users->behance ) || !empty( $users->github ) )
    <div class='links'>
        <h4>Glimpse of my portfolio </h4>
        @if (!empty( $users->website ))
            <a href="{{ $users->website }}"><p>Website</p></a>
        @endif
        @if (!empty( $users->linkedin ))
            <a href="{{ $users->linkedin }}"><p>Linkedin</p></a>
        @endif
        @if (!empty( $users->dribbble ))
            @if(!empty($users->portfolio[0]))
                
                @for ($i = 0; $i < 4; $i++)
                        <a href="{{ $users->portfolio[$i]->link}}">
                            <img src="{{ $users->portfolio[$i]->image}}" alt="portfolio item">
                        </a>
                @endfor
            @endif
        @endif
        @if (!empty( $users->behance ))
            <a href="{{ $users->behance }}"><p>Behance</p></a>
        @endif
        @if (!empty( $users->github ))
            <a href="{{ $users->github }}"><p>Github</p></a>
        @endif
    @endif
        <div id="buttonProfile" v-if="button === {{ $users->id }}">
                <a  href="/user/update"><button type="button" class="btn btn-primary">update profile</button></a>
                <a href="/logout"><button  type="button" class="btn btn-danger">Logout</button></a> 
        </div>  
    </div>
    <script>var user = <?php echo json_encode(session('User')); ?>;</script>
    <script src="{{ asset('js/app.js') }}"></script>
@stop