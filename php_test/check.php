<?php
	/**
	 * 第二套题，第一道
	 * 要求：横竖斜要相等
	 */

	/**
	 * 分析
	 */
	// 横 x1 ,x2, x3
	// 竖 y1, y2, y3
	// 斜 z1, z2
	// x1 = y1 = z1 
	// x2 = y2 = z1 = z2
	// 故可知 横竖斜三条线上的值全部都相等 
	// x1 = a11+a12+a13
	// x2 = a21+a22+a23
	// x3 = a31+a32+a33
	// y1 = a11+a21+a31
	// y2 = a12+a22+a32
	// y3 = a33+a23+a33
	// z1 = a11+a22+a33
	// z2 = a13+a22+a31
	// 其中出现最多的是a22 ，为中间的数，其他的数对角相加都相等，所以只要进行排序，再计算首尾从外往里相加的结果全部相等即可算出结果值。
	/**
	 * 检查九宫格是否可以横竖斜全等
	 * @param  [type] $arr [description]
	 * @return [type]      [description]
	 */
	function checkJiuGong($arr){
		// 所以，先做排序（这里用个最简单的冒泡排序法）(时间复杂度（ O(n^2) ）空间复杂度（ O(1) ）)
		$arr = m_sort($arr);
		// 接下来进行判断，确定全等是否可行
		for($i=0;$i<4;$i++){
			$temp1 = $arr[$i]+$arr[8-$i];
			$temp2 = $arr[$i+1]+$arr[7-$i];
			if($temp1!=$temp2){
				return false;
			}
		}
		return true;
	}

	/**
	 * 冒泡排序法
	 * @param  [type] $arr [description]
	 * @return [type]      [description]
	 */
	function m_sort($arr){
		for($i=0;$i<9;$i++){
			for($j=$i;$j<9;$j++){
				if($arr[$i]>$arr[$j]){
					$ex = $arr[$i];
					$arr[$i] = $arr[$j];
					$arr[$j] = $ex;
				}
			}
		}
		return $arr;
	}
	
	echo 'question 1';

	$j_arr1 = ['1','5','3','4','2','6','7','8','9'];
	$j_arr2 = ['0','5','3','4','2','6','7','8','9'];
	$j_arr3 = ['0','5','3','4','2','6','7','8','10'];

	dump( checkJiuGong($j_arr1) ); 	//true
	dump( checkJiuGong($j_arr2) ); 	//false
	dump( checkJiuGong($j_arr3) ); 	//true
	

	/**
	 * 第二套题，第二道
	 * 要求：求第二岛的大小，（无第二岛求第一岛大小）
	 */
	/**
	 * 分析
	 */
	// 判断是一个岛的条件，需要完全被1包起来,所以，可以以上下左右，四个方向是否全部被1包围则可以算做一个岛
	// 
	// 方案，给与每个0属性，来方便判断及分组,
	// 创建索引来方便查询 点所在信息
	// 首先遍历一次以横向数据组成岛屿片，再将岛屿片合并成为岛屿
	// 最终计算出二岛（唯一岛）的面积
	// 此方案时间复杂度（ O(n2) ） 空间复杂度 （ O(n) ）
	
	/**
	 * 逐行扫描获取结果
	 * @param  [type] $arr [description]
	 * @return [type]      [description]
	 */
	function getIslandInfo($arr){
		// 保存岛屿的信息
		$list = [];
		foreach ($arr as $y => $val) {
			foreach ($val as $x => $v) {
				// 遇到0
				if(empty($v)){
					$list = checkIsland($arr,$x,$y,$list);
				}
			}
		}
		$list = makeIsland($list);
		// dump($list);
		// 计算结果值
		$res = calcuIslandRes($list);
		return $res;
		// dump($list);
	}

	/**
	 * 逐行扫描初步获取岛屿(岛片)信息
	 * @param  [type] $arr [description]
	 * @param  [type] $x   [description]
	 * @param  [type] $y   [description]
	 * @return [type]      [description]
	 */
	function checkIsland($arr,$x,$y,$list){
		// 相关点的位置
		$point_name = $x.','.$y;
		$left_name = ($x-1).','.$y;
		$right_name = ($x+1).','.$y;
		$top_name = $x.','.($y-1);
		$bottom_name = $x.','.($y+1);

		// 横向拼装岛屿
		if (!empty($list['list'][$left_name])){
			$group_name = $list['list'][$left_name];
		}else{
			$group_name = $point_name;
			$list['group'][$group_name]['is_land'] = 1;
		}
		// 索引列表(并记录所属组)
		$list['list'][$point_name] = $group_name;
		// 记录所属岛屿信息（level1,之后还需处理一次，合成整岛）
		$list['group'][$group_name]['land_detail'][] = $point_name;

		//非岛判断
		// 如果为上边界或左边界，则非岛
		if(empty($x)||empty($y)){
			$list['group'][$group_name]['is_land'] = 0;
		}
		// 如果为下边界或右边界，则非岛
		if(!isset($arr[$y+1][$x]) ||!isset($arr[$y][$x+1])){
			$list['group'][$group_name]['is_land'] = 0;
		}
		return $list;
	}

	/**
	 * 处理岛片数据合并成岛屿最终结果信息
	 * @param  [type] $list [description]
	 * @return [type]       [description]
	 */
	function makeIsland($list)
	{
		foreach ($list['list'] as $key => $val) {
			$position = explode(',', $key);
			$top_name = $position[0].','.($position[1]-1);
			if (!empty($list['list'][$top_name])){
				$true_group_name = $list['list'][$top_name];
				$now_group_name = $list['list'][$key];

				// 遍历岛屿归并入上一级
				if(!empty($list['group'][$now_group_name]['land_detail']) && $true_group_name != $now_group_name){
					foreach ($list['group'][$now_group_name]['land_detail'] as $k => $v) {
						$list['group'][$true_group_name]['land_detail'][] = $v;
						$list['list'][$v] = $true_group_name;
					}
					if(empty($list['group'][$now_group_name]['is_land'])){
						$list['group'][$true_group_name]['is_land'] = 0;
					}
					unset($list['group'][$now_group_name]);
				}
			}
		}
		return $list;
	}

	/**
	 * 计算二岛（1岛）面积
	 * @param  [type] $list [description]
	 * @return [type]       [description]
	 */
	function calcuIslandRes($list){
		$max = 0;
		$second = 0;
		foreach ($list['group']as $key => $val) {
			if(!empty($val['is_land'])){
				$m = count($val['land_detail']);
				if($m>$max){
					$second = $max;
					$max = $m;
				}else if($m>$second){
					$second = $m;
				}
			}
		}
		if(empty($second)){
			return $max;
		}
		return $second;
	}

	echo 'question 2';

	$isl_arr1 = [
				['1','1','1','1','1','1'],
				['1','1','0','0','0','1'],
				['1','0','0','0','1','0'],
				['1','1','0','1','1','1'],
				['0','1','0','1','0','0'],
				['1','1','1','1','1','1'],
			];
 
	dump( getIslandInfo($isl_arr1) ); 		//8

	$isl_arr2 = [
				['1','1','1','1','1','1'],
				['1','1','1','0','0','1'],
				['1','0','1','0','1','0'],
				['1','0','0','1','1','1'],
				['0','1','0','1','0','0'],
				['1','1','1','1','1','1'],
			];

	dump( getIslandInfo($isl_arr2) ); 	//3
	
	$isl_arr3 = [
				['1','1','1','1','1','1'],
				['1','1','1','0','0','1'],
				['1','0','1','0','1','0'],
				['1','0','0','0','1','1'],
				['0','1','0','1','0','0'],
				['1','1','1','1','1','1'],
			];

	dump( getIslandInfo($isl_arr3) ); 	//8

	$isl_arr4 = [
				['1','1','1','1','1','1','1'],
				['1','0','1','0','0','0','1'],
				['1','0','1','0','1','1','1'],
				['1','0','0','0','1','0','1'],
				['0','1','0','0','0','0','1'],
				['1','1','1','1','1','1','1'],
			];

	dump( getIslandInfo($isl_arr4) ); 	//14


	/**
	 * 第二套题，第三道
	 * 要求：计算两次交易的最大利润，k为本金
	 */
	/**
	 * 分析
	 */
	// 计算两次交易的最大利润，很显然要低买高卖，所以一定是要先找到最低的买入点
	// b1 第一次买入点
	// s1 第一次卖出点
	// b2 第二次买入点
	// s2 第二次卖出点
	// $max_profit = $arr[$s1]-$arr[$b1]+$arr[$s2]-$arr[$b2];
	
	/**
	 * 情景一 当k=1 时，买入后必须卖出然后才能再次买入
	 */
	/**
	 * 方案一 （笨办法，把所有可能的结果算出来，取结果中的最大值）
	 * 时间复杂度（ O(n^4) ） 空间复杂度（ O(1) ）
	 * @param  string $arr [description]
	 * @return [type]        [description]
	 */
	function calcuMaxPrice1($arr){	
		$ret['max'] = 0;
		$cnt = count($arr);
		for ($b1=0; $b1 < $cnt-1; $b1++) { 
			for ($s1=$b1+1; $s1 < $cnt; $s1++) { 
				for ($b2=$s1+1; $b2 < $cnt+2; $b2++) { 
					for ($s2=$b2+1; $s2 < $cnt+2; $s2++) {
						if($b2>=$cnt || $s2 >= $cnt){
							$part_2 = 0;
							$tempb2 = 0;
							$temps2 = 0;
						}else{
							$part_2 = $arr[$s2]-$arr[$b2];
							$tempb2 = $b2;
							$temps2 = $s2;
						}
						$part_1 = $arr[$s1] - $arr[$b1];
						$now = $part_1 + $part_2;
						if($now > $ret['max']){
							$ret['max'] = $now;
							$ret['b1'] = $b1;
							$ret['s1'] = $s1;
							$ret['b2'] = $tempb2;
							$ret['s2'] = $temps2;
						}
					}
				}
			}
		}
		dump($ret);
		return $ret['max'];
	}

	/**
	 * 方案2 总能在数组中找到若干个递增序列和递减序列，最大利润总是出现在一段增减增这样形状的中，
	 * 所以最大利润值1 = 起始点到终点的差值+起始点到终点间的下降区间的减少值
	 * 所以最大利润值2 = 起始点到终点的差值+终点1之后的第二波最大上升值
	 * 若两种最大利润值都存在则进行对比
	 * @param  [type] $arr [description]
	 * @return [type]      [description]
	 */
	function calcuMaxPrice2($arr){
		$ret['max'] = 0;
		$cnt = count($arr);
		for ($b1=0; $b1 < $cnt-1; $b1++) { 
			// 当遇到第一个上升段,并且是转折点（或是起始点）,则作为假设起始点
			if($arr[$b1] < $arr[$b1+1]){
				if($b1 == 0 || $arr[$b1] < $arr[$b1-1]){
					$ret = calcuMaxPrice2check($arr,$b1,$cnt);
				}
			}
		}
		return $ret['max'];
	}

	/**
	 * 计算以起始点作为第一次买入点之后的最大利润
	 * @param  [type] $arr [description]
	 * @param  [type] $b1  [description]
	 * @param  [type] $cnt [description]
	 * @return [type]      [description]
	 */
	function calcuMaxPrice2check($arr,$b1,$cnt)
	{	
		// 找到起始点之后的最大值
		$max_posi = 0;
		$max = 0;
		for ($i=$b1+1; $i < $cnt; $i++) { 
			if($arr[$i]>$max){
				$max_posi = $i;
				$max = $arr[$i];
			}
		}
		$max_profit =  $max-$arr[$b1];

		if($max['posi']+2 >= $cnt ){
			// 如果右边没有空间则只进行左边的判断并直接输出结果
			if($max['posi']-2 <= $b1){
				// 如果左边没有空间则无需再进行判断，直接返回最大值，并且只能进行一次交易
				$ret['max'] = $max_profit;
				$ret['b1'] = $b1;
				$ret['s1'] = $max_posi;
				$ret['b2'] = 0;
				$ret['s2'] = 0;
			}else{
				$res = calcuMaxPrice2checkRight($arr,$max+1,$cnt);
			}
		}else{
			if($max['posi']-2 <= $b1){
				// 如果左边没有空间则只进行左边的判断
				$res = calcuMaxPrice2checkLeft($arr,$b1+1,$max);
				
			}else{
				// 需要分别判断左右两边进行对比，得出结果
				$res = calcuMaxPrice2checkLeft($arr,$b1+1,$max);

				$res = calcuMaxPrice2checkRight($arr,$max+1,$cnt);
				
			}
			// 如果右边有空间则需要
			
		}
	}

	// 检测右边的方法
	function calcuMaxPrice2checkRight($arr,$start,$cnt){
		// 计算
		$ret['max_profit'] = 0;
		$ret['b2'] = 0;
		$ret['s2'] = 0;
		$temp_b2 = 0;
		$temp_s2 = 0;
		$temp_profit = 0;
		for ($i=$start; $i < $cnt; $i++) { 
			// 当遇到第一个上升段,并且是转折点（或是起始点）,则作为假设起始点
			if($arr[$i] < $arr[$i+1]){
				if($i == $start || $arr[$i] < $arr[$i-1]){
					$temp_b2 = $i;
				}
			}
			if(!empty($temp_b2)){
				$now_profit = 
				if($)
			}
		}
	}

	// 检测左边的方法
	function calcuMaxPrice2checkLeft($arr,$start,$stop)
	{
		# code...
	}

	echo 'question 3';

	$fee_arr1 = ['0','1','2','3','4','5','6'];
	// dump(calcuMaxPrice1($fee_arr1));
	dump(calcuMaxPrice2($fee_arr1));
	$fee_arr2 = ['0','2','1','3','4','5','6'];
	// dump(calcuMaxPrice1($fee_arr2));
	dump(calcuMaxPrice2($fee_arr2));
	$fee_arr3 = ['8','5','1','6','4','2','9','2','10','4','15'];
	dump(calcuMaxPrice1($fee_arr3));
	dump(calcuMaxPrice2($fee_arr3));


	/**
	 * 帮助展示函数
	 * @param  [type] $info [description]
	 * @return [type]       [description]
	 */
	function dump($info){
		echo "<pre>";
		var_dump($info);
		echo "</pre>";
	}