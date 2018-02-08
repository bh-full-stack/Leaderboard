import { Component, OnInit } from '@angular/core';
import { AuthService } from '../../../api/services/auth.service';

declare var jQuery;

@Component({
  selector: 'app-navigation',
  templateUrl: './navigation.component.html',
  styleUrls: ['./navigation.component.css']
})
export class NavigationComponent implements OnInit {
  
  public constructor(public authService: AuthService) {
    //
   }

  public ngOnInit() {
    //
  }

  public hideNavbar() {
    // Timeout is necessary because the click event fires after blur
    window.setTimeout(() => jQuery('#myNavbar').collapse('hide'), 150);
  }

}
