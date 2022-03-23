import { Component, OnInit } from '@angular/core';
import { FormControl, FormGroup, Validators } from '@angular/forms';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {
  public login_form: FormGroup; 

  constructor() { 
    this.login_form = this.createFormGroup();
  }

  ngOnInit(): void {
  }
  
  createFormGroup(){
    return new FormGroup({
      'email': new FormControl('', [Validators.required]),
      'password': new FormControl('', [Validators.required, Validators.minLength(6)])
    })
  }

  login() {
    console.log(this.login_form.value);
  }
  
  changePage() {
    
  }

  get email() { return this.login_form.get('email'); }
  get password() { return this.login_form.get('password'); }


}
