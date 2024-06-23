<!-- Team Area Three -->
@php
    $teams = App\Models\Team::latest()->get();
@endphp
<div class="team-area-three pt-100 pb-70">
    <div class="container">
        <div class="section-title text-center">
            <span class="sp-color">TEAM</span>
            <h2>Let's Meet Up With Our Special Team Members</h2>
        </div>
        <div class="team-slider-two owl-carousel owl-theme pt-45">
            @foreach ($teams as $team)
                <div class="team-item">
                    <a href="team.html">
                        <img src="{{ asset($team->image) }}" alt="Images" />
                    </a>
                    <div class="content">
                        <h3><a href="team.html">{{ $team->name }}</a></h3>
                        <span>{{ $team->position }}</span>
                        <ul class="social-link">
                            <li>
                                <a href="{{ $team->facebook }}" target="_blank"><i class="bx bxl-facebook"></i></a>
                            </li>
                            <li>
                                <a href="#" target="_blank"><i class="bx bxl-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#" target="_blank"><i class="bx bxl-instagram"></i></a>
                            </li>
                            <li>
                                <a href="#" target="_blank"><i class="bx bxl-pinterest-alt"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            @endforeach


        </div>
    </div>
</div>
<!-- Team Area Three End -->
