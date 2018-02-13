import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { SquadPageComponent } from './squad-page.component';

describe('SquadPageComponent', () => {
  let component: SquadPageComponent;
  let fixture: ComponentFixture<SquadPageComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ SquadPageComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(SquadPageComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
