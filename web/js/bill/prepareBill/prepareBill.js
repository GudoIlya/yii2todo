   $(document).ready(function(){
        var totalCalculator = function() {
            var me = this;
            me.totalHolder = false;
            me.totalHolderClass = '.totalHolder';
            me.rowHolderClass = '.calculateTotal';
            me.rateHolderClass = '.rateHolder';
            me.quantityHolderClass = '.quantityHolder';
            me.rowResultHolder = '.resultHolder';

            me.init = function() {
                me.totalHolder = $(document).find(me.totalHolderClass);
                $(document).on('change', me.quantityHolderClass, function(e){
                    var holder = $(this);
                    var row = $(holder).closest(me.rowHolderClass)[0];
                    me.calculateRow(row);
                    me.recalculateTotal();
                });
                me.recalculateTotal();
                return true;
            };
            me.calculateRow = function (row) {
                var rate = $(row).find(me.rateHolderClass).html();
                var quantity = $(row).find(me.quantityHolderClass).val();
                var result = quantity*rate;
                $(row).find(me.rowResultHolder).html(result);
                return result;
            };

            me.recalculateTotal = function() {
                var rows = $(document).find(me.rowHolderClass);
                var totalval = 0;
                if(rows !== undefined) {
                    for(var i = 0; i < rows.length; i++) {
                        totalval += me.calculateRow(rows[i]);
                    }
                }
                me.totalHolder.val(totalval);
                return true;
            };

        };
       var _totalCalc = new totalCalculator();
       _totalCalc.init();
    });