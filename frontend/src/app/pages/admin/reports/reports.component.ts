import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { NgxSpinnerService } from 'ngx-spinner';
import { GeneralService } from 'src/app/services/general.service';

@Component({
  selector: 'app-reports',
  templateUrl: './reports.component.html',
  styleUrls: ['./reports.component.scss']
})
export class ReportsComponent implements OnInit {

  public query1: Array<any> = [];
  public query2: Array<any> = [];
  public query3: Array<any> = [];
  public query3_2: Array<any> = [];
  public query4 : Array<any> = [];
  public query5: Array<any> = [];
  public actors: Array<any> = [];


  constructor(private general_service: GeneralService, private router: Router, private spinner: NgxSpinnerService) { }

  ngOnInit(): void {
    this.spinner.show();
    this.getActors();
    this.getQuery1();
    this.getQuery2(); 
    this.getQuery3();
    this.getQuery3_1();
    this.getQuery4();
    this.getQuery5();
  }
  getActors() {
    this.general_service.getAuth('film').then((res) => {
      this.actors = res.data;
      this.spinner.hide();
    });
  }
  getQuery1() {
    this.general_service.getAuth('top-10-categories/2022-04-01/2022-04-20').then((res) => {
      this.query1 = res.data["top10"];
      this.spinner.hide();
    });
  }
  getQuery2() {
    this.general_service.getAuth('reprod-por-cat/2022-04-01/2022-04-20').then((res) => {
      this.query2 = res.data["repPorCat"];
      this.spinner.hide();
    });
  }
  getQuery3() {
    this.general_service.getAuth('top-10-actors-directors').then((res) => {
      this.query3 = res.data["top10Actors"];
      this.spinner.hide();
    });
  }
  getQuery3_1() {
    this.general_service.getAuth('top-10-actors-directors').then((res) => {
      this.query3_2 = res.data["top10Directors"];
      this.spinner.hide();
    });
  }
  getQuery4() {
    this.general_service.getAuth('created-account-6-months').then((res) => {
      this.query4 = res.data["Cantidad de cuentas avanzadas creadas en los ultimos 6 meses"];
      this.spinner.hide();
    });
  }
  getQuery5() {
    this.general_service.getAuth('hora-pico-por-fecha/2022-04-18').then((res) => {
      this.query5 = res.data["Hora pico para la fecha 2022-04-18"];
      this.spinner.hide();
    });
  }

  edit(id: string) {
    this.router.navigate(['admin/director/' + id]);
  }

  create(){
    this.router.navigate(['admin/director']);
  }

}
