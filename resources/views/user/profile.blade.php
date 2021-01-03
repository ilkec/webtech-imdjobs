@extends('partials.app')

@section('title')
    Profile
@stop
 
@section('content')
    @if( $flash = session('updateMessage') )
        <div class="alert alert-success">{{ $flash }}</div>
    @endif
    
       
    <div class="intro profile-group">
        <h1>{{ $users->first_name }} {{ $users->last_name }}</h1>
    
        @if ($users->account_type == 1 )

            <p id="education-info">Student {{ $users->education }} at {{ $users->school }} </p>
        @endif
        <div class='description'>
            <p>{{ $users->description }}</p>
            @if (!empty( $users->website ) || !empty( $users->linkedin ) || !empty( $users->dribbble ) || !empty( $users->behance ) || !empty( $users->github ) )
                <div class="social-icons">
                    @if (!empty( $users->website ))
                        <a href="{{ $users->website }}"><i class="fas fa-link fa-lg"></i></a>
                    @endif
                    @if (!empty( $users->linkedin ))
                        <a href="{{ $users->linkedin }}"><i class="fab fa-linkedin-in fa-lg"></i></a>
                    @endif
                    @if (!empty( $users->dribbble ))
                        <a href="{{ $users->dribbble }}"><i class="fas fa-basketball-ball fa-lg"></i></a>
                    @endif
                    @if (!empty( $users->behance ))
                        <a href="{{ $users->behance }}"><i class="fab fa-behance fa-lg"></i></a>
                    @endif
                    @if (!empty( $users->github ))
                        <a href="{{ $users->github }}"><i class="fab fa-github fa-lg"></i></a>
                    @endif
                </div>
            @endif
        </div>
    
        <div class="container-img"> 
            @if (empty( $users->picture ))
                <img class="img-thumbnail" src="{{ asset('images/profilePic.jpg') }}" width="500" height="500" alt="profilepicture" id="profilePicture">
            @else
            <img class="img-thumbnail" src="{{ asset('storage/' . $users->picture) }}" width="500" height="500" alt="profilepicture" id="profilePicture">
            @endif
            
            @if (session('User') === $users->id) 
            <div id="buttonSettings">
                <a  href="/user/settings"><button type="button" class="btn btn-light">Account settings</button></a>
            </div>
            @endif
        </div>
    </div>
    <div class='contact profile-group'>
        <h4>Contact </h4>
        <div class="contact-icon">
            <i class="fas fa-envelope fa-lg"></i>
            <p>{{ $users->email }}</p>
        </div>
        <div class="contact-icon">
            <i class="fas fa-phone-alt"></i>
            <p>{{ $users->phone_number }}</p>
        </div> 
        @if (!empty( $users->cv ))
        <a href="{{ asset('storage/' . $users->cv) }}" download="cv_{{ $users->first_name }}_{{ $users->last_name }}">
            <p class="download">Download my cv</p>
        </a>    
        @endif    
    </div>
  
    @if (!empty( $users->dribbble ))
    <div class='links profile-group'>
        <h4>Glimpse of my portfolio </h4>
            @if(!empty($users->portfolio[0]))
                
                @for ($i = 0; $i < 4; $i++)
                        <a href="{{ $users->portfolio[$i]->link}}">
                            <img src="{{ $users->portfolio[$i]->image}}" alt="portfolio item">
                        </a>
                @endfor
            @endif
    @endif
        <div id="buttonProfile" v-if="button == {{ $users->id }}">
                <a  href="/user/update"><button type="button" class="btn btn-primary">update profile</button></a>
                <a href="/logout"><button  type="button" class="btn btn-danger">Logout</button></a> 
        </div>  
    </div>
    <script>var user = <?php echo json_encode(session('User')); ?>;</script>
    <script src="{{ asset('js/app.js') }}"></script>
@stop