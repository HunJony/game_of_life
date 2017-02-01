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
        },
        this.cacheElements = function () {
            this.board = $('table#board');
            this.controlButtons = $('div.controlButtons');
            this.playButton = this.controlButtons.find('button#Play');
            this.prevStepButton = this.controlButtons.find('button#PrevStep');
            this.nextStepButton = this.controlButtons.find('button#NextStep');
        },
        this.addEvents = function () {
            this.playButton.click(this.playButtonClick);
            this.prevStepButton.click(this.prevStepButtonClick);
            this.nextStepButton.click(this.nextStepButtonClick);
        },
        this.addWidgets = function () {

        },
        this.playButtonClick = function() {
            
        },
        this.prevStepButtonClick = function() {

        },
        this.nextStepButtonClick = function() {
            var aliveCells = _self.collectAliveCells();

            $.ajax({
                url: ROOT + 'home/ajax/index/calculateNextGeneration',
                type: 'post',
                dataType: 'json',
                data: {
                    boardWidth: _self.board.data('boardwidth'),
                    boardHeight: _self.board.data('boardheight'),
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
        },
        this.collectAliveCells = function() {
            var aliveCells = [];

            _self.board.find('td.isAlive').each(function(){
                var cell = {'x': $(this).data('x'), 'y': $(this).data('y')};
                aliveCells.push(cell);
            });

            return aliveCells;
        }
    }

    var homeIndex = new HomeIndex();
    homeIndex.init();
});