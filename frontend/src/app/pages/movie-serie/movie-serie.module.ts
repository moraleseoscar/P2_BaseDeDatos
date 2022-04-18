import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { MovieSerieRoutingModule } from './movie-serie-routing.module';
import { MovieSerieComponent } from './movie-serie.component';
import { ComponentsModule } from 'src/app/components/components.module';
import { SafeUrlPipe } from 'src/app/pipes/safe-url.pipe';


@NgModule({
  declarations: [
    MovieSerieComponent,
    SafeUrlPipe
  ],
  imports: [
    CommonModule,
    MovieSerieRoutingModule,
    ComponentsModule
  ]
})
export class MovieSerieModule { }
