import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { AddnewRoutingModule } from './addnew-routing.module';
import { AddnewComponent } from './addnew.component';


@NgModule({
  declarations: [
    AddnewComponent
  ],
  imports: [
    CommonModule,
    AddnewRoutingModule
  ]
})
export class AddnewModule { }
