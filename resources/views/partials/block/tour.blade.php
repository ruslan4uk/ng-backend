<div class="mcontent__tour tour">
        <div class="tour__image">
            <img src="{{ asset('images/main/tours.png') }}" alt="" />
        </div>
        {{-- {% if guide != true %} --}}
        <div class="tour__avatar">
            <img src="{{ asset('images/main/photo.jpg') }}" alt="" />
            <p>Евгения Кулишенко</p>
        </div>
        {{-- {% endif %} --}}
        <a href="" class="tour__title">Музей Ватикана</a>
        <div class="tour__timeline timeline">
            <div class="timeline__wrap">
                <div class="timeline__line"></div>
                <div class="timeline__list hscroll">
                    <div class="timeline__item">Рим
                        <div class="timeline__dot"></div>
                    </div>
                    <div class="timeline__item">Castel Gandolfo
                        <div class="timeline__dot"></div>
                    </div>
                    <div class="timeline__item">Рим
                        <div class="timeline__dot"></div>
                    </div>
                    <div class="timeline__item">Castel Gandolfo
                        <div class="timeline__dot"></div>
                    </div>
                    <div class="timeline__item">Castel Gandolfo
                        <div class="timeline__dot"></div>
                    </div>
                </div>
            </div>					
        </div>
        <div class="tour__info">
            <div class="tour__timing">
                <svg class="tour__timing-icon"><use xlink:href="{{ asset('images/sprite.svg#icon-time') }}"></use></svg>
                <div class="tour__timing-time">1-5 часов</div>
            </div>
            <div class="tour__price">
                <div class="tour__price-start">от</div>
                <div class="tour__price-price">250</div>
                <div class="tour__price-unit">с группы</div>
            </div>
            <a href="#" class="btn btn--gh tour__more">Подробнее</a>
        </div>
    </div>