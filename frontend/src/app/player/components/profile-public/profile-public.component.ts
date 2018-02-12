import { Component, OnInit } from '@angular/core';
import { ChangeDetectorRef } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { DomSanitizer } from '@angular/platform-browser';

import { Player } from '../../models/player';
import { PlayerService } from '../../services/player.service';
import { AuthService } from '../../../api/services/auth.service';
import { Profile } from '../../models/profile';

@Component({
  selector: 'app-profile-public',
  templateUrl: './profile-public.component.html',
  styleUrls: ['./profile-public.component.css']
})
export class ProfilePublicComponent implements OnInit {

  public player: Player;
  public message: string;
  public loading: boolean;
  public profile: Profile;
 
  constructor(
    private _playerService: PlayerService,
    private _authService: AuthService,
    private _ref: ChangeDetectorRef,
    private _activatedRoute: ActivatedRoute,
    private _domSanitizer: DomSanitizer,
    private _router: Router
  ) { }

  ngOnInit() {
    this.loading = true;
    this._activatedRoute.params.subscribe(
      params => this._playerService.showProfile(params.player_id).subscribe(
        player => {
          this.player = player;
          if (this.player.profile) {
            this.profile = Object.assign(new Profile, this.player.profile);
          }
          this.loading = false;
        },
        error => {
          console.log(error);
          if (error.status == 404) {
            this._router.navigate(['']);
          }
          this.loading = false;
        }
          
      )
    )
  }

  public isAuthenticatedPlayer() {
    if (this._authService.player && this.player) {
      return this.player.id == this._authService.player.id;
    } else {
      return false;
    }
  }

}
