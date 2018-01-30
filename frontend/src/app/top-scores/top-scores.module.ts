import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { TopScoresRoutingModule } from './top-scores-routing.module';
import { TopScoresComponent } from './components/top-scores/top-scores.component';
import { TopScoresService } from './services/top-scores.service';

@NgModule({
  imports: [
    CommonModule,
    TopScoresRoutingModule
  ],
  providers: [
    TopScoresService
  ],
  declarations: [TopScoresComponent]
})
export class TopScoresModule { }
