import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { NgxSpinnerService } from 'ngx-spinner';
import { GeneralService } from 'src/app/services/general.service';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.scss']
})
export class HomeComponent implements OnInit {

  public movies_series: Array<any> = [];

  constructor(private general_service: GeneralService, private router: Router, private spinner: NgxSpinnerService) { }

  ngOnInit(): void {
    this.spinner.show();
    this.getMoviesSeries();
  }

  getMoviesSeries() {
    this.general_service.getAuth('movie-serie').then((res) => {
      this.movies_series = res.data;
      this.spinner.hide();
    });
  }

  show(id: string) {
    this.router.navigate(['movie-serie/' + id]);
  }

}
