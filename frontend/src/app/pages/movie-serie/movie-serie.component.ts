import {
  Component,
  OnDestroy,
  OnInit
} from '@angular/core';
import {
  ActivatedRoute,
  Router
} from '@angular/router';
import {
  NgxSpinnerService
} from 'ngx-spinner';
import {
  GeneralService
} from 'src/app/services/general.service';
import Swal from 'sweetalert2';
import { FormControl, FormGroup, Validators } from '@angular/forms';

@Component({
  selector: 'app-movie-serie',
  templateUrl: './movie-serie.component.html',
  styleUrls: ['./movie-serie.component.scss']
})
export class MovieSerieComponent implements OnInit {

  public movie_serie: any;
  public suscripcion: any;
  public awards: Array < any > = [];
  public actors: Array < any > = [];
  public categories: Array < any > = [];
  public related_movies: Array < any > = [];
  public anuncios: Array < any > = [];
  public id = '';
  public playerVars = {
    cc_lang_pref: 'es',
    start: 0
  };
  private player: any;
  public ytEvent: any;
  public veces: number = 0;
  public actor_form: FormGroup;
  public id_movie = '';

  constructor(private route: ActivatedRoute, private general_service: GeneralService, private router: Router, private spinner: NgxSpinnerService) {
    this.actor_form = this.createFormGroup();
    this.id_movie = this.route.snapshot.params['id'];
  }

  ngOnInit(): void {
    this.spinner.show();
    this.getMovieSerie();
    this.getAnuncios();
  }

  getMovieSerie() {
    this.general_service.getAuth('show-movie-serie-detail/' + this.route.snapshot.params['id'] + '/' + localStorage.getItem('profile')).then(res => {
      this.movie_serie = res.data.movie;
      const ids: Array < string > = this.movie_serie.link_video.split('/');
      this.id = ids[ids.length - 1];
      this.awards = res.data.awards;
      this.actors = res.data.actors;
      this.categories = res.data.categories;
      this.related_movies = res.data.related;
      this.suscripcion = res.data.subscription;
      this.playerVars.start = res.data.content.tiempo;
      this.spinner.hide();
    });
  }

  createFormGroup() {
    return new FormGroup({
      id_pelicula: new FormControl(),
      id_perfil:new FormControl()
    });
  }

  getAnuncios() {
    this.general_service.getAuth('anuncio').then(res => {
      this.anuncios = res.data;
      this.spinner.hide();
    });
  }

  formatDate(date: Date) {
    let month = date.getMonth() + 1;
    let day = date.getDate();
    let hours = date.getHours();
    let minutes = date.getMinutes();
    let seconds = date.getSeconds();
    return (
      date.getFullYear() +
      '-' +
      (month.toString().length == 1 ? '0' + month : month) +
      '-' +
      (day.toString().length == 1 ? '0' + day : day) + " " + (hours.toString().length == 1 ? '0' + hours : hours) + ":" + (minutes.toString().length == 1 ? '0' + minutes : minutes) + ":" + (seconds.toString().length == 1 ? '0' + seconds : seconds)
    );
  }

  onStateChange(event: any) {
    this.ytEvent = event.data;
    if (this.ytEvent !== 1) {
      this.general_service.postAuth('content', {
        tiempo: Math.round(this.player.getCurrentTime()),
        id_perfil: localStorage.getItem('profile'),
        id_pelicula: this.route.snapshot.params['id'],
        ultima_vez_visto: this.formatDate(new Date())
      }).then((res) => console.log(res)).catch(err => console.log(err));
    }
    if (this.suscripcion.tipo == 'gratis' && this.veces == 0) {
      if (this.ytEvent == 1) {
        setTimeout(() => {
          this.veces = 1;
          this.mostrarAnuncio();
        }, 10000);
      }
    }
  }

  addFav(){
    this.actor_form.patchValue({ 
      id_pelicula: this.id_movie,
      id_perfil:  window.localStorage.getItem('profile')
    });
    this.general_service
      .postAuth('fav', this.actor_form.value)
      .then((res) => {
        this.spinner.hide();
        Swal.fire({
          icon: 'success',
          title: res.message,
          timer: 100,
          confirmButtonText: 'Aceptar',
        }).then((result) => {
          if (result.isConfirmed) {
            console.log("Agregado a favoritos")
          }
        });
      })
      .catch((err) => {
        this.spinner.hide();
        console.log(err);
      });
  
  }
  
  savePlayer(player: any) {
    this.player = player;
  }

  mostrarAnuncio() {
    this.pauseVideo();
    Swal.fire({
      title: this.anuncios[0].nombre,
      text: this.anuncios[0].descripcion,
      imageUrl: this.anuncios[0].imagen,
      imageWidth: 400,
      imageHeight: 200,
      imageAlt: 'Custom image',
      confirmButtonText: 'Aceptar'
    }).then(res => {
      if (res.isConfirmed) {
        this.playVideo();
      }
    })
  }

  playVideo() {
    this.player.playVideo();
  }

  pauseVideo() {
    this.player.pauseVideo();
  }

}
