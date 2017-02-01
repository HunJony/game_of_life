/**
 * User: Jony
 * Date: 2017. 02. 01.
 * Time: 11:36
 * Project: game_of_life
 * Company: GreenTech
 */
$(document).ready(function () {
    function HomeIndex() {
        var _self = this;

        this.init = function () {
            this.cacheElements();
            this.addEvents();
            this.addWidgets();

            this.playing = false;
        },
        this.cacheElements = function () {
            this.board = $('table#board');
            this.controlButtons = $('div.controlButtons');
            this.playButton = this.controlButtons.find('button#Play');
            this.stopButton = this.controlButtons.find('button#Stop');
            this.prevStepButton = this.controlButtons.find('button#PrevStep');
            this.nextStepButton = this.controlButtons.find('button#NextStep');

            this.boardWidth = $('input[name="width"]');
            this.boardHeight = $('input[name="height"]');

            this.saveActualPattern = $('div.saveActualPattern');
            this.patternName = this.saveActualPattern.find('input[name="patternName"]');
            this.saveActualPatternButton = this.saveActualPattern.find('button#saveActualPattern');
        },
        this.addEvents = function () {
            this.playButton.click(this.playButtonClick);
            this.stopButton.click(this.stopButtonClick);
            this.prevStepButton.click(this.prevStepButtonClick);
            this.nextStepButton.click(this.nextStepButtonClick);
            this.boardWidth.change(this.boardWidthChange);
            this.boardHeight.change(this.boardHeightChange);
            this.board.on('click','td',this.cellClick);
            this.saveActualPatternButton.click(this.saveActualPatternButtonClick);
        },
        this.addWidgets = function () {

        },
        this.playButtonClick = function() {
            _self.playing = true;
            _self.reDraw();
        },
        this.stopButtonClick = function() {
            _self.playing = false;
        },
        this.prevStepButtonClick = function() {

        },
        this.nextStepButtonClick = function() {
            _self.playing = false;
            _self.reDraw();
        },
        this.reDraw = function() {
            if (!_self.validateInput(_self.boardWidth)) return false;
            if (!_self.validateInput(_self.boardHeight)) return false;

            var aliveCells = _self.collectAliveCells();
            var boardWidth = _self.boardWidth.val();
            var boardHeight = _self.boardHeight.val();

            if (aliveCells.length < 1) {
                alert("Kihalás történt!");
                return false;
            }

            $.ajax({
                url: ROOT + 'home/ajax/index/calculateNextGeneration',
                type: 'post',
                dataType: 'json',
                data: {
                    boardWidth: boardWidth,
                    boardHeight: boardHeight,
                    aliveCells: aliveCells
                },
                success: function(data) {
                    var html = "";
                    $.each(data,function(x,row){
                        html += "<tr>";
                        $.each(row,function(y,cell){
                            html += "<td class='"+(cell.isAlive ? 'isAlive' : '')+"' data-x='"+x+"' data-y='"+y+"'>";
                            html += "</td>";
                        });
                        html += "</tr>";
                    });
                    _self.board.empty().html(html);
                }
            });
            if (_self.playing) {
                setTimeout(function () {
                    if (_self.playing) _self.reDraw()
                }, 1000);
            }
        },
        this.collectAliveCells = function() {
            var aliveCells = [];

            _self.board.find('td.isAlive').each(function(){
                var cell = {'x': $(this).data('x'), 'y': $(this).data('y')};
                aliveCells.push(cell);
            });

            return aliveCells;
        },
        this.boardWidthChange = function() {
            _self.validateInput($(this));
        },
        this.boardHeightChange = function() {
            _self.validateInput($(this));
        },
        this.validateInput = function ($this) {
            var value = $this.val();

            if (value == "" || isNaN(value) || value < 1 || !_self.isInt(value)) {
                $this.parent().find('p#errorMessage').text("A mezőben csak pozitív egész szám lehet!");
                return false;
            } else {
                $this.parent().find('p#errorMessage').text("");
                return true;
            }
        },
        this.isInt = function (n) {
            return n % 1 === 0;
        },
        this.cellClick = function() {
            var $this = $(this);
            if ($this.hasClass('isAlive')) {
                $this.removeClass('isAlive');
            } else {
                $this.addClass('isAlive');
            }
        },
        this.saveActualPatternButtonClick = function() {
            var name = _self.patternName.val();
            if (name == "") {
                _self.patternName.parent().find('p#errorMessage').text("Adjon meg egy nevet az aktuálsi mintának!");
                return false;
            }

            _self.saveActualPatternToDatabase(name);
        },
        this.saveActualPatternToDatabase = function(name) {
            if (!_self.validateInput(_self.boardWidth)) return false;
            if (!_self.validateInput(_self.boardHeight)) return false;

            var aliveCells = _self.collectAliveCells();
            var boardWidth = _self.boardWidth.val();
            var boardHeight = _self.boardHeight.val();

            if (aliveCells.length < 1) {
                _self.patternName.parent().find('p#errorMessage').text("A minta üres! Adjon meg pontokat!");
                return false;
            }

            $.ajax({
                url: ROOT + 'home/ajax/index/saveActualPatternToDatabase',
                type: "POST",
                dataType: "json",
                data: {
                    boardWidth: boardWidth,
                    boardHeight: boardHeight,
                    aliveCells: aliveCells,
                    name: name
                },
                success: function(data){

                }
            });
        }
    }

    var homeIndex = new HomeIndex();
    homeIndex.init();
});