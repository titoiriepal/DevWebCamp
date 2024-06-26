import Swiper from "swiper";
import { Navigation, Pagination } from 'swiper/modules';

import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';


document.addEventListener('DOMContentLoaded', function(){
    if(document.querySelector('.slider')){
        const opciones = {
            slidesPerView:1,
            spaceBetween: 15,
            freeMode: true,
            modules:[Navigation, Pagination],
            navigation:{
                nextEl:'.swiper-button-next',
                prevEl:'.swiper-button-prev'
            },
            breakpoints:{
                768:{
                    slidesPerView:2
                },
                1024:{
                    slidesPerView:3
                },
                1200:{
                    slidesPerView:4
                }
            }
        }

        
        new Swiper('.slider', opciones);
    }
})