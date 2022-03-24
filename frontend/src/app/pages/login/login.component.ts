import { Component, OnInit } from '@angular/core';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { GeneralService } from 'src/app/services/general.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {
  public login_form: FormGroup; 

  constructor(private general_service: GeneralService) { 
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
    this.general_service.post('login', this.login_form.value).then(res => {
      console.log(res);
      localStorage.setItem('token', res.access_token);
    }).catch(err => console.log(err));
  }

  get email() { return this.login_form.get('email'); }
  get password() { return this.login_form.get('password'); }

}
