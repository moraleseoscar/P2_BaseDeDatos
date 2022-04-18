import {
  Component,
  OnInit
} from '@angular/core';
import { DomSanitizer } from '@angular/platform-browser';
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

@Component({
  selector: 'app-movie-serie',
  templateUrl: './movie-serie.component.html',
  styleUrls: ['./movie-serie.component.scss']
})
export class MovieSerieComponent implements OnInit {

  public movie_serie: any;
  public awards: Array<any> = [];
  public actors: Array<any> = [];
  public categories: Array<any> = [];
  public related_movies: Array<any> = [];

  constructor(private route: ActivatedRoute, private general_service: GeneralService, private router: Router, private spinner: NgxSpinnerService) {}

  ngOnInit(): void {
    this.spinner.show();
    this.getMovieSerie();
  }

  getMovieSerie() {
    this.general_service.getAuth('show-movie-serie-detail/' + this.route.snapshot.params['id']).then(res => {
      this.movie_serie = res.data.movie;
      this.awards = res.data.awards;
      this.actors = res.data.actors;
      this.categories = res.data.categories;
      this.related_movies = res.data.related;
      this.spinner.hide();
    });
  }

}
