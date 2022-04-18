import {
  Component,
  OnInit
} from '@angular/core';
import {
  FormControl,
  FormGroup,
  Validators
} from '@angular/forms';
import {
  Router
} from '@angular/router';
import {
  NgxSpinnerService
} from 'ngx-spinner';
import {
  GeneralService
} from 'src/app/services/general.service';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.scss']
})
export class HomeComponent implements OnInit {

  public movies_series: Array < any > = [];
  public categories: Array < any > = [];
  public directores: Array < any > = [];
  public actores: Array < any > = [];
  public premios: Array < any > = [];
  public anuncios: Array < any > = [];
  public search_form: FormGroup;
  public tipo: string = "all";
  public id: any = null;

  constructor(private general_service: GeneralService, private router: Router, private spinner: NgxSpinnerService) {
    this.search_form = this.createFormGroup();
  }

  ngOnInit(): void {
    this.getMoviesSeries();
    this.getAnuncios();
    this.getCategories();
    this.getActors();
    this.getAwards();
    this.getDirectors();
  }

  createFormGroup() {
    return new FormGroup({
      'search': new FormControl('', [Validators.required])
    })
  }

  searchText() {
    this.getMoviesSeries(this.tipo, this.id);
  }

  logout() {
    localStorage.clear();
    this.router.navigate(['/login']);
  }

  getMoviesSeries(tipo: any = 'all', id: any = null) {
    this.spinner.show();
    this.tipo = tipo;
    this.id = id;
    const search_value = this.search_form.value.search ? this.search_form.value.search : '-';
    let url = 'filter-movie-serie/' + search_value + '/' + tipo + '/' + id;
    this.general_service.getAuth(url).then((res) => {
      this.movies_series = res.data;
      this.spinner.hide();
    });
  }

  getCategories() {
    this.general_service.getAuth('category').then(res => {
      this.categories = res.data;
      this.spinner.hide();
    });
  }

  getAnuncios() {
    this.general_service.getAuth('anuncio').then(res => {
      this.anuncios = res.data;
      this.spinner.hide();
    });
  }

  getActors() {
    this.general_service.getAuth('some-actors').then(res => {
      this.actores = res.data.data;
      this.spinner.hide();
    });
  }

  getAwards() {
    this.general_service.getAuth('some-awards').then(res => {
      this.premios = res.data.data;
      this.spinner.hide();
    });
  }

  getDirectors() {
    this.general_service.getAuth('some-directors').then(res => {
      this.directores = res.data.data;
      this.spinner.hide();
    });
  }

  show(id: string) {
    this.router.navigate(['movie-serie/' + id]);
  }

  get search() {
    return this.search_form.get('search');
  }

}
